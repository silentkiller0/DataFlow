<?php

namespace App\Http\Controllers;

use App\Models\FluxDocument;
use App\Http\Requests\StoreFluxDocumentRequest;
use App\Http\Requests\UpdateFluxDocumentRequest;

class FluxDocumentController extends Controller
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
     * @param  \App\Http\Requests\StoreFluxDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFluxDocumentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FluxDocument  $fluxDocument
     * @return \Illuminate\Http\Response
     */
    public function show(FluxDocument $fluxDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FluxDocument  $fluxDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(FluxDocument $fluxDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFluxDocumentRequest  $request
     * @param  \App\FluxDocument  $fluxDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFluxDocumentRequest $request, FluxDocument $fluxDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FluxDocument  $fluxDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(FluxDocument $fluxDocument)
    {
        //
    }
}
