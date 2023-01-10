<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Company;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Imports\ImportPartnes;
use Maatwebsite\Excel\Facades\Excel;


class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->id == 1){
            $Partners = Partner::paginate(30);
            $PartnersCount = Partner::count();
        }else{
            $company = Company::where('maincompany_id','=',Auth::user()->company_id)->first();
            $Partners = Partner::where('company_id','=',$company->id)->paginate(30);
            $PartnersCount = Partner::where('company_id','=',$company->id)->count();
        }
        $Company = Company::all();
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show Partners view")));
        return view('partners.index', ['partners' => $Partners,'PartnersCount' => $PartnersCount,'Company' => $Company,'SearchFieldMode' => false, 'SearchField' => false]);
    }
    

    /**
     * Search the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            if($request->field){
                if(Auth::user()->id == 1){
                    $Partners = Partner::where('gln', 'like','%'.$request->field.'%')->paginate(30);
                    $PartnersCount = Partner::count();
                }else{
                    $company = Company::where('maincompany_id','=',Auth::user()->company_id)->first();
                    $Partners = Partner::where('company_id','=',$company->id)->where('gln', 'like','%'.$request->field.'%')->paginate(30);
                    $PartnersCount = Partner::where('company_id','=',$company->id)->count();
                }

                $Company = Company::all();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search Partner : ".$request->field)));
                return view('partners.index', ['partners' => $Partners,'PartnersCount' => $PartnersCount,'Company' => $Company, 'SearchFieldMode' => true,'SearchField' => $request->field]);

            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot search Partner : ".$request->field)));
        }
    }


    /*public function getFreePartners()
    {
        $freePartners = Partner::select(['id', 'name'])->whereNotIn('id',function($query) {

            $query->select('partner_id')->from('companies');
         
        })->get();

        $freePartnersList = [];
        if ($freePartners) {
            foreach ($freePartners as $freePartner) {
                $partner = [
                    "id" => $freePartner->id,
                    "name" => $freePartner->name,
                ];
                array_push($freePartnersList, $partner);
            }
        }
        return $freePartnersList;
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->name && $request->gln) {
                try {
                    $NewPartner = new Partner();
                    $NewPartner->name = $request->name;
                    $NewPartner->company_id	= (Auth::user()->id == 1) ? $request->companie : Auth::user()->company_id;
                    $NewPartner->gln = $request->gln;
                    $NewPartner->adresse = $request->adresse;
                    $NewPartner->description = $request->description;
                    $NewPartner->save();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new partner : ".$request->name)));
                    return redirect('/partners');
                } catch (\Throwable $th) {
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot add new partner")));
                    return redirect('/partners');
                }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $partner = Partner::where('id', $request->id)->first();
            if ($partner) 
            {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show partner details, id :".$request->id)));
                return [
                    "name" => $partner->name,
                    "companie" => $partner->company_id,
                    "gln" => $partner->gln,
                    "adresse" => $partner->adresse,
                    "description" => $partner->description,
                    "id" => $partner->id
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot show partner details, id :".$request->id)));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->partner_id && $request->edit_name){
            try {
                $Partner = Partner::where('id', $request->partner_id)->first();
                if ($Partner) {
                    $Partner->update([
                        "company_id" => $request->edit_companie,
                        "name" => $request->edit_name,
                        "gln" => $request->edit_gln,
                        "adresse" => $request->edit_adresse,
                        "description" => $request->edit_description
                    ]);
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Update partner, id :".$request->partner_id)));
                    return redirect('/partners');
                }
            } catch (\Throwable $th) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot update partner details, id :".$request->partner_id)));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->id){
            try {
                $Partner  = Partner::find($request->id);
                if($Partner){
                    if($Partner->delete()){
                        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete partner, id :".$request->id)));
                        return [
                            'Type' => 'SUCCESS',
                            'Message' => 'Le partenaire '.$Partner->name.' à bien été supprimer'
                        ];
                    }else{
                        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete partner, id :".$request->id)));
                        return [
                            'Type' => 'ERROR',
                            'Message' => 'Impossible de supprimer le partenaire !'
                        ];
                        }
                }else{
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","PARTNERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot found partner in database, id :".$request->id)));
                    return [
                        'Type' => 'WARNING',
                        'Message' => 'Le partenaire est introuvable dans la base de donnée!'
                    ];
                }
           } catch (\Throwable $th) {
            //throw $th;
           }
        }
    }
    
    /**
     * Import partners.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function ImportPartnes(Request $request)
    {
        try {
            if($request->company_id && $request->file){
                try {
                    $company_id = $request->company_id;
                    Excel::import(new ImportPartnes($company_id),$request->file);        
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","IMPORT",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Importation of partners list")));
                    return redirect('/partners');
                } catch (\Throwable $th) {
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","IMPORT",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Can not import partners list")));
                    return redirect('/partners');
                }
            }else{
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","IMPORT",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Can not import partners list")));
                return redirect('/partners');
            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","IMPORT",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Can not import partners list")));
        }
    }
}
