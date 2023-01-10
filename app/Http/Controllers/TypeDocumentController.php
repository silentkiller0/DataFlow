<?php

namespace App\Http\Controllers;

use App\Models\TypeDocument;
use App\Http\Requests\StoreTypeDocumentRequest;
use App\Http\Requests\UpdateTypeDocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;

class TypeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TypeDocuments = TypeDocument::all();
        return view('configurations.index',compact(['TypeDocuments']));
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
     * @param  \App\Http\Requests\StoreTypeDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->statusDOC) {
            $TypeDoc = TypeDocument::where('document_type', $request->statusDOC)->first();
            if (!$TypeDoc) {
                $Doc = new TypeDocument();
                $Doc->document_type = $request->statusDOC;
                $Doc->can_be_edited = 1;
                $Doc->save();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","TYPE DOCUMENTS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new type document, ".$request->statusDOC)));
                return redirect('/configurations?message=DocumentTypeSuccess');
            }else {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("WARNING","TYPE DOCUMENTS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Type document already exists, ".$request->statusDOC)));

                return redirect('/configurations?message=DocumentTypeAlreadyExist');
            }
        }else {
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","TYPE DOCUMENTS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Type document not inserted (bad parameter), ".$request->statusDOC)));
            return redirect('/configurations?message=emptyField');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeDocumentRequest  $request
     * @param  \App\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeDocumentRequest $request, TypeDocument $typeDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $TypeDocument  = TypeDocument::find($request->id);
            if($TypeDocument){
                $TypeDocument->delete();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","TYPE DOCUMENTS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delet Type document, id: ".$request->id)));
                return [
                    'Type' => 'SUCCESS',
                    'Message' => 'Le format de document à bien été supprimer'
                ];
            }else {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","TYPE DOCUMENTS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete Type document, id : ".$request->id)));
                return false;
                return [
                    'Type' => 'WARNING',
                    'Message' => 'Le format de document n\'as pas été supprimer'
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
            //throw $th;
            return [
                'Type' => 'ERROR',
                'Message' => 'Le format de document n\'as pas été supprimer'
            ];
        }
    }
}
