<?php

namespace App\Http\Controllers;

use App\Models\UserPermissions;
use App\Models\Permissions;
use App\Http\Requests\StoreUserPermissionsRequest;
use App\Http\Requests\UpdateUserPermissionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;

class UserPermissionsController extends Controller
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
     * @param  \App\Http\Requests\StoreUserPermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPermissionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->id){
            try {
                $UserPermission = UserPermissions::select(['permission_id'])->where('user_id', $request->id)->get();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show user permission, id : ".$request->id)));
                return $UserPermission;
            } catch (\Throwable $th) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","USERS PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot show user permission, id : ".$request->id)));

            }
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPermissions $userPermissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPermissionsRequest  $request
     * @param  \App\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Permissions = Permissions::select('id')->get();
        $ResetPermissions = UserPermissions::where('user_id', $request->user_id)->delete();
        for($i=0;$i<$Permissions->count();$i++){
            if($Permissions[$i]['id'] == $request[$Permissions[$i]['id']]){
                try {
                    $NewUserPermission = new UserPermissions();
                    $NewUserPermission->permission_id = $Permissions[$i]['id'];
                    $NewUserPermission->user_id = $request->user_id;
                    $NewUserPermission->save();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Update user permission, User ID : ".$request->user_id." - Permission ID : ".$Permissions[$i]['id'])));
                } catch (\Throwable $th) {
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","USERS PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot Update user permission, User ID : ".$request->user_id." - Permission ID : ".$Permissions[$i]['id'])));
                }
            }
        }
        return redirect('/acces');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPermissions $userPermissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function CheckPermission(Request $request)
    {
        //
    }

}
