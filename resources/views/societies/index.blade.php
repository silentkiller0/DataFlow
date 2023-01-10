@extends('layouts.master')
@section('title', '- Societes')
@include('layouts.OptionsPermissions')
@section('content')

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    <!-- END: Custom CSS-->
    <!-- BEGIN: Content-->
    <!-- BEGIN: Content-->
    <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper mt-0">
            
            <div class="content-body">
                <!-- Data list view starts -->
                <section id="data-list-view" class="data-list-view-header horizontal-menu-wrapper">

                    <!-- DataTable starts -->
                    <div class="table-responsive" style="overflow-x: none!important;">
                        <div class="top">
                            <div class="actions action-btns mt-0"> 
                                <div class="dt-buttons btn-group">
                                @if(CheckOptionsPermission('add_societies'))
                                    <button class="btn btn-primary" id="newSocietyModalBtn" tabindex="0" aria-controls="DataTables_Table_0" data-target="#newSocietyModal" data-toggle="modal">
                                        <i class="feather icon-plus"></i><span data-i18n="newcompany">New company</span>
                                    </button> 
                                @endif
                                </div>
                            </div>
                            <div class="action-filters  row">
                                <div class="dataTables_length" id="DataTables_Table_0_length">
                                @if($SearchFieldMode)
                                    <a href="/societies" class="btn btn-danger" id="DeleteFiltrebtn">
                                        <i class="fa fa-times-circle" style="margin-right:5px"></i><span data-i18n="deletefiltre">Supprimer le filtre</span>
                                    </a>
                                @endif

                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <label>
                                            <input value="{{$SearchField ?? ''}}" type="search" class="form-control form-control-sm" placeholder="Raison sociale" aria-controls="DataTables_Table_0"  id="search" name="search">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ @csrf_field() }}
                            <table class="table data-list-view">
                                <thead>
                                    <tr width="100%">
                                        <th hidden></th>
                                        <th width="60%" data-i18n="namecompany">Company name</th>
                                        <th width="25%" data-i18n="datecreationsiege">Date de creation</th>
                                        <th width="15%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($societies as $society)
                                    <tr data-company-id="{{$society->id}}">
                                        <td hidden></td>
                                        <td class="society-name">{{$society->name}}</td>
                                        <td class="society-price">{{$society->created_at}}</td>
                                        <td class="society-action">
                                            <button class="btn p-1  btn-primary" id="EditCompanyModalbtn" tabindex="0" aria-controls="DataTables_Table_0" data-target="#updateSocietyModal" data-company-id="{{$society->id}}" data-toggle="modal">
                                                <span><i class="feather icon-edit"></i></span>
                                            </button> 
                                            @if(CheckOptionsPermission('delete_societies'))
                                                <button class="btn p-1 btn-danger" data-company-id="{{$society->id}}" id="deleteSocietyBtn">
                                                    <span class=""><i class="feather icon-trash"></i></span>
                                                </button> 
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        <div class="bottom">
                            <div class="actions"></div>
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    @if($societies->count() == 20)
                                        <li class="paginate_button page-item previous" id="DataTables_Table_0_previous">
                                            <a href="{{$societies->previousPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                            <a href="{{$societies->nextPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- DataTable ends -->

                @if(CheckOptionsPermission('add_societies'))
                    <!-- Modal -->
                    <div class="modal fade text-left" id="newSocietyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17" data-i18n="newcompany">New company</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/societies/add">
                                        <div class="modal-body">
                                            <div class="data-items pb-3 ps">
                                                    <div class="data-fields px-2 mt-3">
                                                                {{ @csrf_field() }}
                                                                <div class="row">
                                                                    <div class="col-sm-12 data-field-col">
                                                                        <label for="name" data-i18n="rs">Social Reason</label>
                                                                        <input name="name" type="text" class="form-control" id="name"><br>
                                                                    </div>
                                                                    <div class="col-sm-6 data-field-col">
                                                                        <label for="email">Email</label>
                                                                        <input name="email" type="email" class="form-control" id="email">
                                                                    </div>
                                                                    <div class="col-sm-6 data-field-col">
                                                                        <label for="telephone" data-i18n="tel">Phone Number</label>
                                                                        <input name="telephone" type="text" class="form-control" id="telephone"><br>
                                                                    </div>
                                                                    @if(Auth::user()->id == 1)
                                                                        <div class="col-sm-12 data-field-col">
                                                                            <label for="data-companie" data-i18n="siegecp">Head office</label>
                                                                            <select name="maincompanie" class="form-control" id="maincompanie">
                                                                            @foreach($mainCompanies as $mc) 
                                                                                <option value="{{$mc->id}}" class="admin">{{$mc->name}}</option>
                                                                            @endforeach
                                                                            </select><br>
                                                                        </div>
                                                                    @endif
                                                                    <div class="col-sm-12 data-field-col">
                                                                        <label for="website">Site Web</label>
                                                                        <input name="website" type="url" class="form-control" id="website" placeholder="http://...">
                                                                    </div>
                                                                </div>
                                                    </div>
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="newSocietySubmitBtn" class="btn btn-primary"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="add">Add</span></button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                    <!-- update Modal -->
                    <div class="modal fade text-left horizontal-menu-wrapper" id="updateSocietyModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="updateModalLabel" data-i18n="UpdateCP">Update company informations</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/societies/edit">
                                        <div class="modal-body">
                                            <div class="data-items">
                                                        <div class="data-fields">
                                                            {{ @csrf_field() }}
                                                            <div class="row">
                                                                <input hidden name="company_id" id="company_id">
                                                                <div class="col-sm-12 data-field-col">
                                                                    <label for="edit_name" data-i18n="rs">Sociale Reason</label>
                                                                    <input name="edit_name" type="text" class="form-control" id="edit_name" required><br>
                                                                </div>
                                                                <div class="col-sm-6 data-field-col">
                                                                    <label for="edit_email">Email</label>
                                                                    <input name="edit_email" type="email" class="form-control" id="edit_email">
                                                                </div>
                                                                <div class="col-sm-6 data-field-col">
                                                                    <label for="edit_telephone" data-i18n="tel">Phone Number</label>
                                                                    <input name="edit_telephone" type="tel" class="form-control" id="edit_telephone"><br>
                                                                </div>
                                                                @if(Auth::user()->id == 1)
                                                                        <div class="col-sm-12 data-field-col">
                                                                            <label for="data-companie" data-i18n="siegecp">Head office</label>
                                                                            <select name="edit_maincompanie" class="form-control" id="edit_maincompanie">
                                                                            @foreach($mainCompanies as $mc) 
                                                                                <option value="{{$mc->id}}" class="admin">{{$mc->name}}</option>
                                                                            @endforeach
                                                                            </select><br>
                                                                        </div>
                                                                @endif
                                                                <div class="col-sm-12 data-field-col">
                                                                    <label for="edit_website">Site Web</label>
                                                                    <input name="edit_website" type="url" class="form-control" id="edit_website" placeholder="http://...">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                    </div><br>


                                                    <div class="alert alert-primary mt-1 alert-validation-msg" role="alert" style="height: 150px;overflow-y: auto">
                                                        <h4 class="modal-title" data-i18n="partnerattached">Partners attached to this company</h4><br>
                                                        <span><div id="partners"></div></span>
                                                    </div><br>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            @if(CheckOptionsPermission('edit_societies'))
                                                <button type="submit" id="updateSocietySubmitBtn" class="btn btn-primary"><i class="fa fa-check-circle" style="margin-right:5px"></i><span data-i18n="update">Update</span></button>
                                            @endif
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Data list view end -->
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endsection
@include('includes.societies')


