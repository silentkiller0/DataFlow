<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Http\Requests\StoreLogsRequest;
use App\Http\Requests\UpdateLogsRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;
use App\Models\Flux;
use App\Models\Partner;
use App\Models\Company;
use App\Models\mainCompany;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {

        if(Auth::user()->id == 1){
            //Invoices Statisiques
            $InvoicesSuccessCount = Flux::where('type_flux','=','invoice')->where('status_id','=','1')->count();
            $InvoicesErrorsCount = Flux::where('type_flux','=','invoice')->where('status_id','=','2')->count();
            //Orders Statisiques
            $OrdersSuccessCount = Flux::where('type_flux','=','order')->where('status_id','=','1')->count();
            $OrdersErrorsCount = Flux::where('type_flux','=','order')->where('status_id','=','2')->count();
            //Desadv Statisiques
            $DesadvSuccessCount = Flux::where('type_flux','=','desadv')->where('status_id','=','1')->count();
            $DesadvErrorsCount = Flux::where('type_flux','=','desadv')->where('status_id','=','2')->count();
        }else{
            //Invoices Statisiques
            $InvoicesSuccessCount = Flux::where('type_flux','=','invoice')->where('company_id','=',Auth::user()->company_id)->where('status_id','=','1')->count();
            $InvoicesErrorsCount = Flux::where('type_flux','=','invoice')->where('company_id','=',Auth::user()->company_id)->where('status_id','=','2')->count();
            //Orders Statisiques
            $OrdersSuccessCount = Flux::where('type_flux','=','order')->where('company_id','=',Auth::user()->company_id)->where('status_id','=','1')->count();
            $OrdersErrorsCount = Flux::where('type_flux','=','order')->where('company_id','=',Auth::user()->company_id)->where('status_id','=','2')->count();
            //Desadv Statisiques
            $DesadvSuccessCount = Flux::where('type_flux','=','desadv')->where('company_id','=',Auth::user()->company_id)->where('status_id','=','1')->count();
            $DesadvErrorsCount = Flux::where('type_flux','=','desadv')->where('company_id','=',Auth::user()->company_id)->where('status_id','=','2')->count();
        }
        //Statistiques users
        $UsersActiveCount = User::where('active','=','1')->count();
        $UsersDesactiveCount = User::where('active','=','0')->count();
        //Entreprise users
        $Partners = Partner::count();
        $Companies = Company::count();
        $mainCompanies = mainCompany::count();

		return view('dashboard.dashboard',['InvoicesCount' => $InvoicesSuccessCount + $InvoicesErrorsCount,'InvoicesSuccessCount' => $InvoicesSuccessCount,'InvoicesErrorsCount' => $InvoicesErrorsCount,
        'OrdersCount' => $OrdersSuccessCount + $OrdersErrorsCount,'OrdersSuccessCount' => $OrdersSuccessCount,'OrdersErrorsCount' => $OrdersErrorsCount,
        'DesadvCount' => $DesadvSuccessCount + $DesadvErrorsCount,'DesadvSuccessCount' => $DesadvSuccessCount,'DesadvErrorsCount' => $DesadvErrorsCount,
        'UsersActiveCount' => $UsersActiveCount,'UsersDesactiveCount' => $UsersDesactiveCount,"mainCompaniesCount" => $mainCompanies,"CompaniesCount" => $Companies,"PartnersCount" => $Partners
    ]);
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
     * Show about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function support()
    {
        return view('home.support');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLogsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function show(request $request)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function edit(Logs $logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLogsRequest  $request
     * @param  \App\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogsRequest $request, Logs $logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        
    }
}
