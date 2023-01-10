<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\PartnerController;
use App\Models\mainCompany;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mainCompanies = mainCompany::paginate(20);
        $societies = Company::paginate(20);
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show companies")));
		return view('societies.index', ['societies' => $societies,'mainCompanies' =>$mainCompanies,'SearchFieldMode' => false, 'SearchField' => false]);
    }

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
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            if ($request->name) {
                try {
                    $NewCompany = new Company();
                    $NewCompany->maincompany_id = $request->maincompanie;
                    $NewCompany->name = $request->name;
                    $NewCompany->email = $request->email;
                    $NewCompany->telephone = $request->telephone;
                    $NewCompany->website = $request->website;
                    $NewCompany->save();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Insert new companie, name :".$request->name)));
                    return redirect('/societies');
                } catch (\Throwable $th) {
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot insert the new companie, name :".$request->name)));
                    return redirect('/societies');
                }
            }
    }


    /**
     * Search the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            if($request->field){
                $mainCompanies = mainCompany::paginate(20);
                $Company = Company::where('name', 'like','%'.$request->field.'%')->paginate(20);
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search for company name :".$request->field)));
                return view('societies.index', ['societies' => $Company,'mainCompanies' =>$mainCompanies, 'SearchFieldMode' => true,'SearchField' => $request->field]);
            }
        } catch (\Throwable $th) {
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search return false, Cannot found company name :".$request->field)));
            //throw $th;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->edit_name && $request->company_id) 
        {
            try {
                $society = Company::where('id', $request->company_id)->first();
                if ($society) {
                    $society->update([
                        "maincompany_id" => $request->edit_maincompanie,
                        "name" => $request->edit_name,
                        "email" => $request->edit_email,
                        "telephone" => $request->edit_telephone,
                        "website" => $request->edit_website
                    ]);
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Update company name :".$request->edit_name)));
                    return redirect('/societies');
                }
            } catch (\Throwable $th) {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot Update company name :".$request->edit_name)));
                return redirect('/societies');
            }
        }
    }

    /*    
    public function multipleDelete(Request $request)
    {
        $selectedSocieties = $request->selectedSocieties;
        if (count($selectedSocieties) > 0) {
            foreach ($selectedSocieties as $selected_society_id) {
                $society = Company::where('id', $selected_society_id)->first();
                $society->delete();
            }
            return redirect('/societies');
        }else {
            return redirect('/societies?message=emptyField');
        }
    }*/
    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $Company = Company::where('id', $request->id)->first();
            $partners = Partner::select('name')->where('company_id','=',$Company->id)->get();
            if ($Company) 
            {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show company details, name :".$Company->name)));
                return [
                    "maincompanie" => $Company->maincompany_id,
                    "name" => $Company->name,
                    "email" => $Company->email,
                    "telephone" => $Company->telephone,
                    "website" => $Company->website,
                    "id" => $Company->id,
                    "partners" => $partners
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot show company details, id :".$request->id)));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if($request->id){
                $Partners = Partner::where('company_id','=',$request->id)->count();
                if($Partners == 0){
                    $Company  = Company::find($request->id);
                    if($Company){
                        if($Company->delete()){
                            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete company, id :".$request->id)));
                            return [
                                'Type' => 'SUCCESS',
                                'Message' => 'La société '.$Company->name.' à bien été supprimer'
                            ];
                        }else{
                            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete company, id :".$request->id)));
                            return [
                                'Type' => 'ERROR',
                                'Message' => 'Impossible de supprimer la société '.$Company->name.' !'
                            ];
                        }
                    }
                }else{
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","COMPANIES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"A lot of partners are attached to this company, id :".$request->id)));
                    return [
                        'Type' => 'WARNING',
                        'Message' => 'Un ou plusieurs partenaires sont dèja attribuées à cette sociétés !'
                    ];
                }
            
        }
    }
}
