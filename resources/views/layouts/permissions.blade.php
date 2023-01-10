<?php
use App\Models\UserPermissions;
use App\Models\Permissions;

function checkPerm($droit){
    try {
        $GetIdPermission = Permissions::select('id')->where('name','=',$droit)->first();
        $checkPerm = UserPermissions::where('user_id','=',Auth::id())->where('permission_id','=',$GetIdPermission->id)->first();
        if($checkPerm){ return 1;}else{return 0;}
    } catch (\Throwable $th) {
        return 0;
    }
}
?>