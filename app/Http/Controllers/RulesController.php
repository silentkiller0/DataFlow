<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use App\Http\Requests\StoreRulesRequest;
use App\Http\Requests\UpdateRulesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;
class RulesController extends Controller
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
     * @param  \App\Http\Requests\StoreRulesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->role_name) {
            try {
                $Rule = Rules::where('rule', $request->role_name)->first();
                if (!$Rule) {
                    $NewRule = new Rules();
                    $NewRule->rule = $request->role_name;
                    $NewRule->can_be_edited = 1;
                    $NewRule->save();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new rule, ".$request->role_name)));
                    return redirect('/permissions');
                }
            } catch (\Throwable $th) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot add new rule, ".$request->role_name)));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function show(Rules $rules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function edit(Rules $rules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRulesRequest  $request
     * @param  \App\Rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRulesRequest $request, Rules $rules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rules  $rules
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->id){
            try {
                $Rule  = Rules::find($request->id);
                if($Rule){
                    $Rule->delete();
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete rule, id: ".$request->id)));

                    return true;
                }
            } catch (\Throwable $th) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PERMISSIONS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete rule, id : ".$request->id)));
            }
        }
    }
}
