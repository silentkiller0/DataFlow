@extends('layouts.master')
@section('title', '- Accès')
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
                                
                            </div>
                            <div class="action-filters row">
                                <div class="dataTables_length" id="DataTables_Table_0_length">
                                    @if($SearchFieldMode)
                                        <a href="/acces" class="btn btn-danger" id="DeleteFiltrebtn">
                                            <i class="fa fa-times-circle" style="margin-right:5px"></i><span data-i18n="deletefiltre">Delete filtre</span>
                                        </a>
                                    @endif
                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <label>
                                            <input value="{{$SearchField ?? ''}}"  placeholder="Nom d'utilisateur" type="text" class="form-control form-control-sm"  autocomplete="off" id="search" name="search">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <table class="table data-list-view">
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th data-i18n="username" width="60%">Username</th>
                                    <th data-i18n="rule">Rule</th>
                                    <th data-i18n="etat">Etat</th>
                                    <th data-i18n="datecreationsiege" width="25%">Creation date</th>
                                    <th width="10%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Users as $User)
                                @if(Auth::id() != $User->id)
                                    <tr>
                                        <td hidden></td>
                                        <td class="user-name">{{$User->username}}</td>
                                        <td>
                                            <div @if ($User->userRule->id == 1) class="chip chip-danger" @elseif ($User->userRule->id == 2) class="chip chip-warning" @else class="chip chip-primary" @endif >
                                                <div class="chip-body">
                                                    <div class="chip-text">{{$User->userRule->rule}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($User->active == 1 )
                                            <div class="chip chip-success"><div class="chip-body"><div class="chip-text">Oui</div></div></div>
                                            @else
                                            <div class="chip chip-danger"><div class="chip-body"><div class="chip-text">Non</div></div></div>
                                            @endif
                                        </td>
                                        <td>{{$User->created_at}}</td>

                                        <td class="user-action">
                                            <button class="btn p-1 btn-primary" tabindex="0" aria-controls="DataTables_Table_0" id="permissionsmodalbtn" data-user-id="{{$User->id}}" data-target="#permissionsmodal" data-toggle="modal">
                                                <span><i class="feather icon-shield"></i></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div class="bottom">
                            <div class="actions"></div>
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    @if($Users->count() == 20)
                                        <li class="paginate_button page-item previous" id="DataTables_Table_0_previous">
                                            <a href="{{$Users->previousPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                            <a href="{{$Users->nextPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- DataTable ends -->

                  
                    <div class="modal fade horizontal-menu-wrapper" id="permissionsmodal" tabindex="-1" role="dialog" aria-labelledby="permissionsmodalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <form class="modal-content" method="post" action="/acces/edit">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="permissionsmodalTitle" data-i18n="userperm">User permissions</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"><br>
                                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                            <span data-i18n="permtxt1">Attention, only the rights related to the permissions created are displayed here.</span><br>
                                            <span data-i18n="permtxt2">You can add other rights on the Permissions->Roles and Permissions page.</span>
                                        </div><br>
                                            <table class="table table-hover mb-0">
                                                {{ @csrf_field() }}
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="85%" data-i18n="rights">Droits</th>
                                                        <th width="15%">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <input hidden name="user_id" id="user_id">
                                                    <input hidden value="{{$Permissions->count()}}" id="CountPermissions">
                                                    @foreach($Permissions as $Permission) 
                                                        <tr>
                                                            <th scope="row">{{$Permission->display_name}}</th>
                                                            <th scope="row" class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                                <input class="custom-control-input" type="checkbox" value="{{$Permission->id}}" name="{{$Permission->id}}" id="permission_{{$Permission->id}}">
                                                                <label class="custom-control-label" for="permission_{{$Permission->id}}">
                                                                    <span class="switch-icon-left" style="margin-top:1.7px !important"><i class="feather icon-shield"></i></span>
                                                                    <span class="switch-icon-right" style="margin-top:1.7px !important"><i class="feather icon-slash"></i></span>
                                                                </label>
                                                            </th>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle" style="margin-right:5px"></i><span data-i18n="update">Update</span></button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Cancel</button>
                                </div> 
                        </form>
                    </div>
                    </div>
                </section>
        </div>
    </div>
    <!-- END: Content-->


@endsection
@include('includes.acces')