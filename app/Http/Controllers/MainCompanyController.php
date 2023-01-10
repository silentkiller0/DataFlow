<?php

namespace App\Http\Controllers;
use App\Models\mainCompany;
use App\Models\Company;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Http\Request;

class MainCompanyController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MainCompany = mainCompany::paginate(20);
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show Main Company view")));
		return view('mainCompany.index', ['MainCompany' => $MainCompany,'SearchFieldMode' => false, 'SearchField' => false]);
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
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search Main Company : ".$request->field)));
                $mainCompanies = mainCompany::where('name', 'like','%'.$request->field.'%')->paginate(20);
                return view('mainCompany.index', ['MainCompany' => $mainCompanies,'SearchFieldMode' => true,'SearchField' => $request->field]);

            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoremainCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            if ($request->name) {
                try {
                    $NewmainCompany = new mainCompany();
                    $NewmainCompany->name = $request->name;
                    $NewmainCompany->email = $request->email;
                    $NewmainCompany->telephone = $request->telephone;
                    $NewmainCompany->website = $request->website;
                    $NewmainCompany->save();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new Main Company : ".$request->name)));
                    return redirect('/MainCompany');
                } catch (\Throwable $th) {
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot insert Main Company : ".$request->name)));
                    return redirect('/MainCompany');
                }
            }
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\mainCompany  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->edit_name && $request->company_id) 
        {
            try {
                $society = mainCompany::where('id', $request->company_id)->first();
                if ($society) {
                    $society->update([
                        "name" => $request->edit_name,
                        "email" => $request->edit_email,
                        "telephone" => $request->edit_telephone,
                        "website" => $request->edit_website
                    ]);
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Update Main Company : ".$request->edit_name)));
                    return redirect('/MainCompany');
                }
            } catch (\Throwable $th) {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot update Main Company : ".$request->edit_name)));
                return redirect('/MainCompany');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\mainCompany  $Company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $mainCompany = mainCompany::where('id', $request->id)->first();
            $Companies = Company::select('name')->where('maincompany_id','=',$mainCompany->id)->get();
            $Users = User::select('id','firstname','lastname')->where('company_id','=',$mainCompany->id)->get();
            if ($mainCompany) 
            {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show Main Company details : ".$mainCompany->name)));
                return [
                    "name" => $mainCompany->name,
                    "email" => $mainCompany->email,
                    "telephone" => $mainCompany->telephone,
                    "website" => $mainCompany->website,
                    "id" => $mainCompany->id,
                    "Companies" => $Companies,
                    "Users" => $Users
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot show Main Company details, id: ".$request->id)));
        }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mainCompany  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->id){
                $User = User::where('company_id','=', $request->id)->count();
                if($User == 0){
                    $Companies = Company::where('maincompany_id','=',$request->id)->count();
                    if($Companies == 0){
                        $mainCompany  = mainCompany::find($request->id);
                        if($mainCompany){
                            if($mainCompany->delete()){
                                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete Main Company, id: ".$request->id)));
                                return [
                                    'Type' => 'SUCCESS',
                                    'Message' => 'Le siège '.$mainCompany->name.' à bien été supprimer'
                                ];
                            }else{
                                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete Main Company, id: ".$request->id)));
                                return [
                                    'Type' => 'ERROR',
                                    'Message' => 'Impossible de supprimer le siège '.$mainCompany->name.' !'
                                ];
                            }
                        }
                    }else{
                        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete Main Company, some companies are attached, id: ".$request->id)));
                        return [
                            'Type' => 'WARNING',
                            'Message' => 'Une ou plusieurs entreprises sont dèja attribuées à ce siège !'
                        ];
                    }
                }else{
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","MAIN COMPANY",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete Main Company, some users are attached, id: ".$request->id)));
                    return [
                        'Type' => 'WARNING',
                        'Message' => 'Un ou plusieurs utilisateurs sont dèja attribués à ce siège !'
                    ];
                }
        }
    } 
}
