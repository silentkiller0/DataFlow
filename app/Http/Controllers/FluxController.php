<?php

namespace App\Http\Controllers;

use App\Models\Flux;
use App\Models\Partner;
use App\Models\FluxStatus;
use App\Models\Company;
use App\Http\Requests\StoreFluxRequest;
use App\Http\Requests\UpdateFluxRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
class FluxController extends Controller
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
     * Display a listing of the Invoices flow.
     *
     * @return \Illuminate\Http\Response
     */
    public function InvoicesList()
    {
        $Partners = Partner::all();
        $FluxStatus = FluxStatus::all();
        if(Auth::user()->id == 1){
            $Invoices = Flux::where('type_flux','=','invoice')->paginate(20);
        }else{
            $company = Company::where('maincompany_id','=',Auth::user()->company_id)->first();
            $Invoices = Flux::where('type_flux','=','invoice')->where('company_id','=',$company->id)->paginate(20);
        }
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","INVOICES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show Invoices list view")));
		return view('flux.invoices', ['Invoices' => $Invoices,'Partners' => $Partners,'FluxStatus' => $FluxStatus,'SearchFieldMode' => false, 'SearchField' => false]);
    }

    /**
     * Show desadv.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowInvoice(request $request){
        try {
            $invoice = Flux::where('id', $request->id)->where('type_flux','=','invoice')->first();
            if ($invoice) 
            {
                $client_livraison = Partner::where('gln', $invoice->gln_livraison)->first();
                $client_commande = Partner::where('gln', $invoice->gln_client)->first();
                $fournisseur = Partner::where('gln', $invoice->gln_fournisseur)->first();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","INVOICE",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show invoice details, id :".$request->id)));
                return [
                    "nom_client_livraison" => $client_livraison ? $client_livraison->name : '---',	
                    "gln_livraison" => 	$invoice->gln_livraison,
                    "adr_client_livraison" => $client_livraison ? $client_livraison->adresse : '---',	
                    "siege_client_livraison" => $client_livraison ? (Company::where('id', '=',$client_livraison->company_id)->first()->name ?? '---') : '---',
                    "nom_client_commande" => $client_commande ? $client_commande->name : '---',
                    "gln_client_commande" => $invoice->gln_client ?? '---',
                    "adr_client_commande" => $client_commande ? $client_commande->adresse : '---',
                    "siege_client_commande" =>$client_commande ? (Company::where('id', '=',$client_commande->company_id)->first()->name ?? '---') : '---',
                    "syslog_id" => $invoice->syslog_id ?? '---',
                    "partner_id" => $invoice->partner_id ?? '---',
                    "company_id" => $invoice->company_id ?? '---',
                    "status_id" => $invoice->status_id ?? '---',
                    "type_flux" => $invoice->type_flux ?? '---',
                    "ref_order" => $invoice->ref_order ?? '---',
                    "date_order" => $invoice->date_order ?? '---',
                    "ref_invoice" => $invoice->ref_invoice ?? '---',	
                    "date_reception_desadv" => $invoice->date_reception_desadv ?? '---',
                    "ref_invoice" => $invoice->ref_invoice ?? '---',
                    "date_invoicing" => $invoice->date_invoicing ?? '---',
                    "date_document" => $invoice->date_document ?? '---',
                    "gln_fournisseur" => $invoice->gln_fournisseur ?? '---',
                    "date_livraison" => $invoice->date_livraison ?? '---',
                    "adresse_livraison" => $invoice->adresse_livraison ?? '---',	
                    "content" => $invoice->content ?? '---',
                    "ref_desadv" => $invoice->ref_desadv ?? '---',
                    "nom_fournisseur" => $fournisseur ? (Company::where('id', '=',$fournisseur->company_id)->first()->name ?? '---') : '---',
                ];
            }else{
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot found invoice in database, id :".$request->id)));
            }
        } catch (Exception $e) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Error trying to show invoice :".$e->getMessage())));
        }
}  

    




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchInvoices(request $request)
    {
        $syslog_id=strip_tags($request->syslog_id);
        $ref_facture=strip_tags($request->ref_facture);
        $date_facturation=strip_tags($request->date_facturation);
        $ref_commande=strip_tags($request->ref_commande);
        $date_commande=strip_tags($request->date_commande);
        $gln_client=strip_tags($request->gln_client);
        $gln_fournisseur=strip_tags($request->gln_fournisseur);
        $status_id=strip_tags($request->status_id);

        $Partners = Partner::all();
        $FluxStatus = FluxStatus::all();
        $invoices = DB::table('fluxes');
        $contentINV ="";
        if(!empty($syslog_id)){
            $invoices->where('syslog_id','like','%'.$syslog_id.'%');
            $contentINV .= "syslog_id :".$syslog_id;
        }
        if(!empty($ref_facture)){
            $invoices->where('ref_invoice','like','%'.$ref_facture.'%');
            $contentINV .= "ref_invoice :".$ref_facture;
        }
        if(!empty($date_facturation)){
            $invoices->where('date_invoicing','=',$date_facturation);
            $contentINV .= "date_invoicing :".$date_facturation;
        }
        if(!empty($ref_commande)){
            $invoices->where('ref_order','like','%'.$ref_commande.'%');
            $contentINV .= "ref_order :".$ref_commande;
        }
        if(!empty($date_commande)){
            $invoices->where('date_order','=',$date_commande);
            $contentINV .= "date_order :".$date_commande;
        }
        if(!empty($gln_client)){
            $invoices->where('gln_client','like','%'.$gln_client.'%');
            $contentINV .= "gln_client :".$gln_client;
        }
        if(!empty($gln_fournisseur)){
            $invoices->where('gln_fournisseur','like','%'.$gln_fournisseur.'%');
            $contentINV .= "gln_fournisseur :".$gln_fournisseur;
        }
        if(!empty($status_id)){
            $invoices->where('status_id','like','%'.$status_id.'%');
            $contentINV .= "status_id :".$status_id;
        }
        if(Auth::user()->id == 1){
            $invoices->where('type_flux','=','invoice');
            $contentINV .= "type_flux : type_flux";
        }else{
            $invoices->where('type_flux','=','invoice')->where('company_id','=',Auth::user()->company_id);
            $contentINV .= "company_id :".Auth::user()->company_id;
        }
        $FinalQuery = $invoices->paginate(20);
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","INVOICES",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search Invoices, QUERY : ".$contentINV)));
		return view('flux.invoices', ['Invoices' => $FinalQuery,'Partners' => $Partners,'FluxStatus' => $FluxStatus,'SearchFieldMode' => false, 'SearchField' => false]);
    }


    /**
     * Display a listing of the Invoices flow.
     *
     * @return \Illuminate\Http\Response
     */
    public function desadvList()
    {
        $Partners = Partner::all();
        $FluxStatus = FluxStatus::all();
        if(Auth::user()->id == 1){
            $desadv = Flux::where('type_flux','=','desadv')->paginate(20);
        }else{
            $desadv = Flux::where('type_flux','=','desadv')->where('company_id','=',Auth::user()->company_id)->paginate(20);
        }
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show DESADV List view")));

		return view('flux.desadv', ['desadv' => $desadv,'Partners' => $Partners,'FluxStatus' => $FluxStatus,'SearchFieldMode' => false, 'SearchField' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchDesadv(request $request)
    {
        $syslog_id=strip_tags($request->syslog_id);
        $ref_desadv=strip_tags($request->ref_desadv);
        $date_desadv=strip_tags($request->date_desadv);
        $ref_commande=strip_tags($request->ref_commande);
        $date_commande=strip_tags($request->date_commande);
        $gln_client=strip_tags($request->gln_client);
        $gln_fournisseur=strip_tags($request->gln_fournisseur);
        $status_id=strip_tags($request->status_id);
        $Partners = Partner::all();
        $FluxStatus = FluxStatus::all();
        $desadv = DB::table('fluxes');
        $contentDESADV = "";
        if(!empty($syslog_id)){
            $desadv->where('syslog_id','like','%'.$syslog_id.'%');
            $contentDESADV .= "syslog_id :".$syslog_id;
        }
        if(!empty($ref_desadv)){
            $desadv->where('ref_desadv','like','%'.$ref_desadv.'%');
            $contentDESADV .= "ref_desadv :".$ref_desadv;
        }
        if(!empty($date_desadv)){
            $desadv->where('date_reception_desadv','=',$date_desadv);
            $contentDESADV .= "date_reception_desadv :".$date_desadv;
        }
        if(!empty($ref_commande)){
            $desadv->where('ref_order','like','%'.$ref_commande.'%');
            $contentDESADV .= "ref_order :".$ref_commande;
        }
        if(!empty($date_commande)){
            $desadv->where('date_order','=',$date_commande);
            $contentDESADV .= "date_order :".$date_commande;
        }
        if(!empty($gln_client)){
            $desadv->where('gln_client','like','%'.$gln_client.'%');
            $contentDESADV .= "gln_client :".$gln_client;
        }
        if(!empty($gln_fournisseur)){
            $desadv->where('gln_fournisseur','like','%'.$gln_fournisseur.'%');
            $contentDESADV .= "gln_fournisseur :".$gln_fournisseur;
        }
        if(!empty($status_id)){
            $desadv->where('status_id','like','%'.$status_id.'%');
            $contentDESADV .= "status_id :".$status_id;
        }
        if(Auth::user()->id == 1){
            $desadv->where('type_flux','=','desadv');
            $contentDESADV .= "type_flux : desadv";
        }else{
            $desadv->where('type_flux','=','desadv')->where('company_id','=',Auth::user()->company_id);
            $contentDESADV .= "company_id :".Auth::user()->company_id;
        }
        $FinalQuery = $desadv->paginate(20);
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search DESADV, QUERY : ".$contentDESADV)));
		return view('flux.desadv', ['desadv' => $FinalQuery,'Partners' => $Partners,'FluxStatus' => $FluxStatus,'SearchFieldMode' => false, 'SearchField' => false]);
    }


     /**
     * Edit Desadv address
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateAdr(request $request)
    {
        if($request->gln && $request->adr){
            $Partner = Partner::where('gln', $request->gln)->first();
            if ($Partner) {
                $Partner->update(["adresse" => $request->adr]);
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","Flux",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Partner addresse changed for :".$request->gln)));
                return ["adresse" => $request->adr];
            } 
        }
    }


    /**
     * Display a listing of the Invoices flow.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordersList()
    {
        $Partners = Partner::all();
        $FluxStatus = FluxStatus::all();
        if(Auth::user()->id == 1){
            $orders = Flux::where('type_flux','=','order')->paginate(20);
        }else{
            $orders = Flux::where('type_flux','=','order')->where('company_id','=',Auth::user()->company_id)->paginate(20);
        }
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","ORDERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show orders list view")));
		return view('flux.orders', ['orders' => $orders,'Partners' => $Partners,'FluxStatus' => $FluxStatus,'SearchFieldMode' => false, 'SearchField' => false]);
    }

    
    /**
     * Show order.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowOrder(request $request){
        try {
            $order = Flux::where('id', $request->id)->where('type_flux','=','order')->first();
            if ($order) 
            {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","ORDERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show order details, id :".$request->id)));
                
                $client_livraison = Partner::where('gln', $order->gln_livraison)->first();
                $client_commande = Partner::where('gln', $order->gln_client)->first();
                $fournisseur = Partner::where('gln', $order->gln_fournisseur)->first();

                return [
                    "nom_client_livraison" => $client_livraison ? $client_livraison->name : '---',	
                    "gln_livraison" => 	$order->gln_livraison,
                    "adr_client_livraison" => $client_livraison ? $client_livraison->adresse : '---',	
                    "siege_client_livraison" => $client_livraison ? (Company::where('id', '=',$client_livraison->company_id)->first()->name ?? '---') : '---',
                    "nom_client_commande" => $client_commande ? $client_commande->name : '---',
                    "gln_client_commande" => $order->gln_client ?? '---',
                    "adr_client_commande" => $client_commande ? $client_commande->adresse : '---',
                    "siege_client_commande" =>$client_commande ? (Company::where('id', '=',$client_commande->company_id)->first()->name ?? '---') : '---',
                    "syslog_id" => $order->syslog_id ?? '---',
                    "partner_id" => $order->partner_id ?? '---',
                    "company_id" => $order->company_id ?? '---',
                    "status_id" => $order->status_id ?? '---',
                    "type_flux" => $order->type_flux ?? '---',
                    "ref_order" => $order->ref_order ?? '---',
                    "date_order" => $order->date_order ?? '---',
                    "date_document" => $order->date_document ?? '---',
                    "gln_fournisseur" => $order->gln_fournisseur ?? '---',
                    "date_livraison" => $order->date_livraison ?? '---',
                    "adresse_livraison" => $order->adresse_livraison ?? '---',	
                    "content" => $order->content ?? '---',
                    "nom_fournisseur" => $fournisseur ? (Company::where('id', '=',$fournisseur->company_id)->first()->name ?? '---') : '---',
                ];
            }else{
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot found order in database, id :".$request->id)));
            }
        } catch (Exception $e) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Error trying to show order :".$e->getMessage())));
        }
}  


    /**
     * Show desadv.
     *
     * @return \Illuminate\Http\Response
     */
    public function ShowDesadv(request $request){
            try {
                $desadv = Flux::where('id', $request->id)->where('type_flux','=','desadv')->first();
                if ($desadv) 
                {
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show DESADV details, id :".$request->id)));
                    $client_livraison = Partner::where('gln', $desadv->gln_livraison)->first();
                    $client_commande = Partner::where('gln', $desadv->gln_client)->first();
                    $fournisseur = Partner::where('gln', $desadv->gln_fournisseur)->first();
                    return [
                        "nom_client_livraison" => $client_livraison ? $client_livraison->name : '---',	
                        "gln_livraison" => 	$desadv->gln_livraison,
                        "adr_client_livraison" => $client_livraison ? $client_livraison->adresse : '---',	
                        "siege_client_livraison" => $client_livraison ? (Company::where('id', '=',$client_livraison->company_id)->first()->name ?? '---') : '---',
                        "nom_client_commande" => $client_commande ? $client_commande->name : '---',
                        "gln_client_commande" => $desadv->gln_client ?? '---',
                        "adr_client_commande" => $client_commande ? $client_commande->adresse : '---',
                        "siege_client_commande" =>$client_commande ? (Company::where('id', '=',$client_commande->company_id)->first()->name ?? '---') : '---',
                        "syslog_id" => $desadv->syslog_id ?? '---',
                        "partner_id" => $desadv->partner_id ?? '---',
                        "company_id" => $desadv->company_id ?? '---',
                        "status_id" => $desadv->status_id ?? '---',
                        "type_flux" => $desadv->type_flux ?? '---',
                        "ref_order" => $desadv->ref_order ?? '---',
                        "date_order" => $desadv->date_order ?? '---',
                        "ref_invoice" => $desadv->ref_invoice ?? '---',	
                        "date_reception_desadv" => $desadv->date_reception_desadv ?? '---',
                        "ref_invoice" => $desadv->ref_invoice ?? '---',
                        // "date_invoicing" => $desadv->date_invoicing ?? '---',
                        "date_document" => $desadv->date_document ?? '---',
                        "gln_fournisseur" => $desadv->gln_fournisseur ?? '---',
                        "date_livraison" => $desadv->date_livraison ?? '---',
                        "adresse_livraison" => $desadv->adresse_livraison ?? '---',	
                        "content" => $desadv->content ?? '---',
                        "ref_desadv" => $desadv->ref_desadv ?? '---',
                        "nom_fournisseur" => $fournisseur ? (Company::where('id', '=',$fournisseur->company_id)->first()->name ?? '---') : '---',
                    ];
                }else{
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot found desadv in database, id :".$request->id)));
                }
            } catch (Exception $e) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Error trying to show desadv :".$e->getMessage())));
            }
    }      
    
        
    /**
     * Download desadv.
     *
     * @return \Illuminate\Http\Response
     */
    public function DownloadDesadv(request $request){

        try {
            $desadv = Flux::where('id', $request->id_flux)->where('type_flux', '=','desadv')->first();
            if($desadv){
                $contents = $desadv->content;
                $filename = 'DESADV_'.$desadv->ref_desadv.'_'.date('dmY_His').'.'.$request->type_file;
                return response()->streamDownload(function () use ($contents) {
                    echo $contents;
                }, $filename);
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Download DESADV ref :".$desadv->ref_desadv)));
            }
        } catch (Exception $e) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","DESADV",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Error trying to Download DESADV ref :".$desadv->ref_desadv." Error :".$e->getMessage())));
        }

    }
    
    /**
     * Download Invoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function DownloadInvoice(request $request){

        try {
            $invoice = Flux::where('id', $request->id_flux)->where('type_flux', '=','invoice')->first();
            if($invoice){
                $contents = $invoice->content;
                $filename = 'INVOICE_'.$invoice->ref_invoice.'_'.date('dmY_His').'.'.$request->type_file;
                return response()->streamDownload(function () use ($contents) {
                    echo $contents;
                }, $filename);
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","INVOICE",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Download Invoice ref :".$invoice->ref_invoice)));
            }
        } catch (Exception $e) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","INVOICE",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Error trying to Download Invoice ref :".$invoice->ref_invoice." Error :".$e->getMessage())));
        }

    }

    /**
     * Download order.
     *
     * @return \Illuminate\Http\Response
     */
    public function DownloadOrder(request $request){

        try {
            $order = Flux::where('id', $request->id_flux)->where('type_flux', '=','order')->first();
            if($order){
                $contents = $order->content;
                $filename = 'ORDER_'.$order->ref_order.'_'.date('dmY_His').'.'.$request->type_file;
                return response()->streamDownload(function () use ($contents) {
                    echo $contents;
                }, $filename);
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","ORDERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Download Order ref :".$order->ref_order)));
            }
        } catch (Exception $e) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","ORDERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Error trying to Download Order ref :".$order->ref_order." Error :".$e->getMessage())));
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchOrders(request $request)
    {
        $syslog_id=strip_tags($request->syslog_id);
        $ref_commande=strip_tags($request->ref_commande);
        $date_commande=strip_tags($request->date_commande);
        $gln_client=strip_tags($request->gln_client);
        $gln_fournisseur=strip_tags($request->gln_fournisseur);
        $status_id=strip_tags($request->status_id);
        $Partners = Partner::all();
        $FluxStatus = FluxStatus::all();
        $orders = DB::table('fluxes');
        $contentOrder = "";
        if(!empty($syslog_id)){
            $orders->where('syslog_id','like','%'.$syslog_id.'%');
            $contentOrder .= "syslog_id :".$syslog_id;
        }
        if(!empty($ref_commande)){
            $orders->where('ref_order','like','%'.$ref_commande.'%');
            $contentOrder .= " - ref_order :".$ref_commande;
        }
        if(!empty($date_commande)){
            $orders->where('date_order','=',$date_commande);
            $contentOrder .= " - date_order :".$date_commande;
        }
        if(!empty($gln_client)){
            $orders->where('gln_client','like','%'.$gln_client.'%');
            $contentOrder .= " - gln_client :".$gln_client;
        }
        if(!empty($gln_fournisseur)){
            $orders->where('gln_fournisseur','like','%'.$gln_fournisseur.'%');
            $contentOrder .= " - gln_fournisseur :".$gln_fournisseur;
        }
        if(!empty($status_id)){
            $orders->where('status_id','like','%'.$status_id.'%');
            $contentOrder .= " - status_id :".$status_id;
        }
        if(Auth::user()->id == 1){
            $orders->where('type_flux','=','order');
            $contentOrder .= " - type_flux : order";
        }else{
            $orders->where('type_flux','=','order')->where('company_id','=',Auth::user()->company_id);
            $contentOrder .= " - company_id :".Auth::user()->company_id;
        }
        $FinalQuery = $orders->paginate(20);
    
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","ORDERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search orders, QUERY : ".$contentOrder)));
		return view('flux.orders', ['orders' => $FinalQuery,'Partners' => $Partners,'FluxStatus' => $FluxStatus,'SearchFieldMode' => false, 'SearchField' => false]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dematInvoice()
    {
        return view('demat.index');

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
     * @param  \App\Http\Requests\StoreFluxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFluxRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flux  $flux
     * @return \Illuminate\Http\Response
     */
    public function show(Flux $flux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flux  $flux
     * @return \Illuminate\Http\Response
     */
    public function edit(Flux $flux)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFluxRequest  $request
     * @param  \App\Flux  $flux
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFluxRequest $request, Flux $flux)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flux  $flux
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flux $flux)
    {
        //
    }
}
