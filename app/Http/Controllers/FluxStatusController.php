<?php

namespace App\Http\Controllers;

use App\Models\FluxStatus;
use App\Http\Requests\StoreFluxStatusRequest;
use App\Http\Requests\UpdateFluxStatusRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
class FluxStatusController extends Controller
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
     * @param  \App\Http\Requests\StoreFluxStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->statusFL) {
            $flux = FluxStatus::where('status', $request->statusFL)->first();
            if (!$flux) {
                $FluxStatus = new FluxStatus();
                $FluxStatus->status = $request->statusFL;
                $FluxStatus->color = $request->colorFL;
                $FluxStatus->can_be_edited = 1;
                $FluxStatus->save();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","FLUXSTATUS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new Flux status : ".$request->statusFL)));
                return redirect('/configurations?message=FluxStatusSuccess');
            }else {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","FLUXSTATUS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Flux already exists")));
                return redirect('/configurations?message=FluxStatusAlreadyExist');
            }
        }else {
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","FLUXSTATUS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show Invoices list view")));
            return redirect('/configurations?message=emptyField');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function show(FluxStatus $fluxStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(FluxStatus $fluxStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFluxStatusRequest  $request
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFluxStatusRequest $request, FluxStatus $fluxStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FluxStatus  $fluxStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       try {
            $FluxStatus  = FluxStatus::find($request->id);
            if($FluxStatus){
                $FluxStatus->delete();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","FLUXSTATUS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete flux, id : ".$request->id)));
                return [
                    'Type' => 'SUCCESS',
                    'Message' => 'Le Status de flux à bien été supprimer'
                ];
            }else {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","FLUXSTATUS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete flux status, id : ".$request->id)));
                return [
                    'Type' => 'WARNING',
                    'Message' => 'Le Status de flux n\'as pas été supprimer'
                ];            }
       } catch (\Throwable $th) {
        //throw $th;
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","FLUXSTATUS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete flux status, id : ".$request->id)));
        return [
            'Type' => 'ERROR',
            'Message' => 'Le Status de flux n\'as pas été supprimer'
        ];
       }
    }
}
