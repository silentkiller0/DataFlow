<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Http\Requests\StoreTransportRequest;
use App\Http\Requests\UpdateTransportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Transports = Transport::all();
        return view('configurations.index',compact(['Transports']));

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
     * @param  \App\Http\Requests\StoreTransportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->statusTR) {
            $Transport = Transport::where('transport_type', $request->statusTR)->first();
            if (!$Transport) {
                $TransportStatus = new Transport();
                $TransportStatus->transport_type = $request->statusTR;
                $TransportStatus->can_be_edited = 1;
                $TransportStatus->save();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new transport, ".$request->statusTR)));

                return redirect('/configurations?message=TransportStatusSuccess');
            }else {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot ddd new transport, ".$request->statusTR)));

                return redirect('/configurations?message=TransportStatusAlreadyExist');
            }
        }else {
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot add new transport, ".$request->statusTR)));
            return redirect('/configurations?message=emptyField');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransportRequest  $request
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransportRequest $request, Transport $transport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Transport  = Transport::find($request->id);
        if($Transport){
            $Transport->delete();
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete transport, id : ".$request->id)));
            return true;

        }else {
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delte transport, id : ".$request->id)));
            return false;
        }
    }
}
