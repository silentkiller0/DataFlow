<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use Illuminate\Http\Request;
use App\Models\UserPermissions;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->name) {
            try {
                $Permission = Permissions::where('name', $request->name)->first();
                if (!$Permission) {
                    $NewPermission = new Permissions();
                    $NewPermission->display_name = $request->display_name;
                    $NewPermission->name = $request->name;
                    $NewPermission->can_be_edited = 1;
                    $NewPermission->save();

                    //Give the new acces to the super administrator
                    $NewUserPermission = new UserPermissions();
                    $NewUserPermission->permission_id = $NewPermission->id;
                    $NewUserPermission->user_id = 1;
                    $NewUserPermission->save();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new permission, ".$request->name)));
                    return redirect('/permissions');
                }
            } catch (\Throwable $th) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot add new permission, ".$request->name)));

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit(Permissions $permissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, Permissions $permissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->id){
            try {
                $Permission  = Permissions::find($request->id);
                if($Permission){
                    $Permission->delete();
                    $UsersPermissions = UserPermissions::where('permission_id', $request->id)->delete();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete permission, ".$request->id)));
                    return true;
                }
            } catch (\Throwable $th) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete permission, ".$request->id)));

            }
        }
    }
}
