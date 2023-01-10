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

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
       
        $Users = User::paginate(20);
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","LOGS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Open Logs view")));
		return view('logs.index',['Users' => $Users]);
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
        
        try {
            $file = Storage::disk('local')->get('\logs\\'.$request->id.'.log');
            if($file){
                $filesize = Storage::disk('local')->size('\logs\\'.$request->id.'.log');
                $filecontentLines = explode(PHP_EOL, $file);
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","LOGS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show logs for user id : ".$request->id)));
                return [
                    'Type' => 'SUCCESS',
                    'Message' => 'SUCCESS',
                    'Size' => $filesize,
                    'Logs' => $filecontentLines
                ];
            }else{
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","LOGS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"No logs to show for user id : ".$request->id)));
                return [
                    'Type' => 'ERROR',
                    'Message' => 'Pas de logs trouver pour le moment !',
                    'Size' => false,
                    'Logs' => false
                ];
            }
        } catch (\Throwable $th) {
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","LOGS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"No logs files found for user id : ".$request->id)));
            return [
                'Type' => 'ERROR',
                'Message' => 'Pas de logs trouver pour le moment !',
                'Size' => false,
                'Logs' => false
            ];
        }


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
        Storage::disk('local')->delete('\logs\\'.$request->id.'.log');
        return redirect('/logs');
    }
}
