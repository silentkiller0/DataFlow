<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (Auth::user()->active == 1) {
            //Insert Connection DateTime
            $user = Auth::user();
            $user->last_connection = date('Y-m-d H:i:s');
            $user->save();
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","AUTH",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"User Connected")));
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","AUTH",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"User Non-active try to connect")));
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => '']);
        }
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","AUTH",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"User Disconnected")));

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
