<?php
use App\Models\UserPermissions;
use App\Models\Permissions;

function CheckPermission($droit){
    try {
        $GetIdPermission = Permissions::select('id')->where('name','=',$droit)->first();
        $CheckPermission = UserPermissions::where('user_id','=',Auth::id())->where('permission_id','=',$GetIdPermission->id)->first();
        if($CheckPermission){ return 1;}else{return 0;}
    } catch (\Throwable $th) {
        return 0;
    }
}
?>