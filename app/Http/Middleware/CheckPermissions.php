<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\UserPermissions;
use App\Models\Permissions;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $GetIdPermission = Permissions::select('id')->where('name','=',$request->route()->getName())->first();
            $CheckPermission = UserPermissions::where('user_id','=',Auth::id())->where('permission_id','=',$GetIdPermission->id)->first();
            if($CheckPermission){ return $next($request); }
            else{ return response()->view('errors.404'); }
        }else{ return response()->view('auth.login'); }
    }
}
