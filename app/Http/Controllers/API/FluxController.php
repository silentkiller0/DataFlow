<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flux;

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
     * Flux insertion API (REST:GET)
     * 
     * 
     * Conditions           :   Send 0 in case the parameter is empty
     * 
     * Required parameters  :   Send => Type_flux = invoice or order or desadv 
     *                          Send => ref_order or ref_desadv or ref_invoice
     * 
     * URl                  : http://XXXXXX/flux/senddata/{syslog_id}/{status_id}/{type_flux}/{date_document}/{ref_order}/{date_order}/{ref_desadv}/{date_reception_desadv}/{ref_invoice}/{date_invoicing}/{gln_client}/{gln_fournisseur}/{gln_livraison}/{date_livraison}/{adresse_livraison}/{content}/
     * 
     * Exemple              : http://127.0.0.1:8000/api/flux/senddata/454/1/invoice/2022-12-18/CM00002/2022-12-23/0/2022-12-24/FC00002/2022-12-25/7777777777777/5555555555555/33333333333333/2022-12-24/Paris/test/
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            try{
                if($request->type_flux && ($request->ref_order || $request->ref_desadv || $request->ref_invoice)){
                    Flux::create([
                        'syslog_id' => $request->syslog_id != 0 ? $request->syslog_id : NULL,
                        'status_id' => $request->status_id != 0 ? $request->status_id : NULL,
                        'type_flux' => $request->type_flux != "0" ? $request->type_flux : NULL,
                        'date_document'	=> $request->date_document != 0 ? $request->date_document : NULL,
                        'ref_order' => $request->ref_order != "0" ? $request->ref_order : NULL,
                        'date_order' => $request->date_order != 0 ? $request->date_order : NULL,
                        'ref_desadv' => $request->ref_desadv != "0" ? $request->ref_desadv : NULL,
                        'date_reception_desadv' => $request->date_reception_desadv != 0 ? $request->date_reception_desadv : NULL,
                        'ref_invoice' => $request->ref_invoice != "0" ? $request->ref_invoice : NULL,
                        'date_invoicing' => $request->date_invoicing != 0 ? $request->date_invoicing : NULL,
                        'gln_client' => $request->gln_client != "0" ? $request->gln_client : NULL,
                        'gln_fournisseur' => $request->gln_fournisseur != "0" ? $request->gln_fournisseur : NULL,
                        'gln_livraison' => $request->gln_livraison != "0" ? $request->gln_livraison : NULL,
                        'date_livraison' => $request->date_livraison != 0 ? $request->date_livraison : NULL,
                        'adresse_livraison' => $request->adresse_livraison != "0" ? $request->adresse_livraison : NULL,
                        'content' => $request->content != "0" ? $request->content : NULL
                    ]);
                    return "Flux inserted";
                }else{
                    return "Document ref not found !";
                }
            } catch (\Throwable $th) {
                return "Error :".$th;
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
