@extends('layouts.master')
@section('title', '- Configurations')

@section('content')

            <section class="horizontal-menu-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12 d-flex align-items-stretch">
                            <div class="card" style="width:100%">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25" data-i18n="sftitle">Flow Status</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <button data-toggle="modal" data-target="#AddStatusFlux" class="btn btn-primary float-right btn-inline" style="width:100%"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="newsf">Add new flow status</span></button><br>
                                    </div>
                                    <div class="table-responsive"  style="padding: 20px">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th data-i18n="color">Color</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($FluxStatus as $Flux) 
                                                    <tr>
                                                        <th scope="row">{{$Flux->status}}</th>
                                                        <th scope="row">
                                                        <div class="chip" style="background-color:{{$Flux->color}}"><div class="chip-body"><div class="chip-text text-white">{{$Flux->color}}</div></div></div></th>
                                                        <th>
                                                        @if ($Flux->can_be_edited == 0)
                                                            <button class="btn-icon btn btn-secondary btn-round float-right btn-inline"><i class="fa fa-times"></i></button>
                                                        @else    
                                                            <button class="btn-icon btn btn-danger btn-round float-right btn-inline" id="DeleteSF" data-id="{{$Flux->id}}"><i class="fa fa-times"></i></button>
                                                        @endif
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12 d-flex align-items-stretch horizontal-menu-wrapper">
                            <div class="card" style="width:100%">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25" data-i18n="tdtitle">Documents format</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <button data-toggle="modal" data-target="#AddDocumentType" class="btn btn-primary float-right btn-inline" style="width:100%" aria-controls="DataTables_Table_0"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="newtd">Add a new document format</span></button><br>
                                    </div>
                                    <div class="table-responsive"  style="padding: 20px">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th data-i18n="typed">Type of document</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($TypeDocuments as $Document) 
                                                    <tr>
                                                        <th scope="row">{{$Document->document_type}}</th>
                                                        <th>
                                                        @if ($Document->can_be_edited == 0)
                                                            <button class="btn-icon btn btn-secondary btn-round float-right btn-inline" type="button" ><i class="fa fa-times"></i></button>
                                                        @else
                                                            <button class="btn-icon btn btn-danger btn-round float-right btn-inline" id="DeleteFD" data-id="{{$Document->id}}"><i class="fa fa-times"></i></button>
                                                        @endif
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>


                            <!-- Modal : Status des flux -->
                            <div class="modal fade text-left horizontal-menu-wrapper" id="AddStatusFlux" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel18" data-i18n="sftitle">Flow Status</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <form id="AddStatusFlux" method="POST" action="/configurations/AddStatusFlux">
                                                {{ @csrf_field() }}
                                                <div class="modal-body">
                                                    <p data-i18n="newsf">
                                                        Add new flow status
                                                    </p>
                                                    
                                                    <div class="form-group">
                                                        <label for="firstName1" data-i18n="sfname">Status name</label>
                                                        <input type="text" id="statusFL" name="statusFL" class="form-control" placeholder="Ex : Pending">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="firstName1" data-i18n="sfcolor">Status color</label>
                                                        <input type="color" id="colorFL" name="colorFL" class="form-control">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="AddStatusFlux"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="add">Add</span></button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Cancel</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal : Format des documents-->
                            <div class="modal fade text-left horizontal-menu-wrapper" id="AddDocumentType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel18" data-i18n="tdtitle">Documents format</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="AddTypeDoc" method="POST" action="/configurations/AddTypeDoc">
                                            {{ @csrf_field() }}
                                            <div class="modal-body">
                                                <p data-i18n="newtd">
                                                    Add a new document format
                                                </p>
                                                <fieldset class="form-group">
                                                    <input type="text" id="statusDOC" name="statusDOC" class="form-control" placeholder="Ex : doc">
                                                </fieldset>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" id="AddTypeDoc"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="add">Add</span></button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



@endsection
@include('includes.configurations')
