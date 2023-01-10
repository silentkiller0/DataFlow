<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('APP_KEY');
        //$token=config('global.APP_KEY');
        //return response()->json(["token" => $token]);
        /*if($token != "AZERTYUIOP"){
            return response()->json(["message" => $token],401);
        }*/
        return response()->json(["message" => $request],401);

        //return $next($request);
        //return response()->json(["token" => $request->route('dashboard')]);

    }
}
