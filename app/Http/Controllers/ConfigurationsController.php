<?php

namespace App\Http\Controllers;

use App\Models\FluxStatus;
use App\Models\Transport;
use App\Models\TypeDocument;
use App\Models\Rules;
use App\Models\Permissions;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;

use App\Http\Requests\StoreFluxStatusRequest;
use App\Http\Requests\UpdateFluxStatusRequest;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FluxStatus = FluxStatus::all();
        $TypeDocuments = TypeDocument::all();
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","CONFIGURATIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show Configurations view")));
		return view('configurations.index', ['FluxStatus' => $FluxStatus,'TypeDocuments' => $TypeDocuments]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        $Rules = Rules::all();
        $Permissions = Permissions::all();
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show permissions view")));
		return view('permissions.index', ['Rules' => $Rules,'Permissions' => $Permissions]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function acces()
    {
        $Users = User::all();
        $Permissions = Permissions::all();
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","ACCES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show acces view")));
		return view('permissions.acces', ['Users' => $Users,'Permissions' => $Permissions,'SearchFieldMode' => false, 'SearchField' => false]);
    }


        /**
     * Search the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function searchacces(Request $request)
    {
        try {
            if($request->field){
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","ACCES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search acces, id :".$request->field)));
                $Users = User::where('username', 'like','%'.$request->field.'%')->paginate(20);
                $UserPermissions = UserPermissions::all();
                return view('permissions.acces', ['Users' => $Users,'UserPermissions' => $UserPermissions,'SearchFieldMode' => true, 'SearchField' => $request->field]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","ACCES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot found acces, id :".$request->field)));

        }
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
     * @param  \App\Http\Requests\StoreFluxStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function show(FluxStatus $fluxStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(FluxStatus $fluxStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFluxStatusRequest  $request
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFluxStatusRequest $request, FluxStatus $fluxStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request/*FluxStatus $fluxStatus*/)
    {
       
    }
}
