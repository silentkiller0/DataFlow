@extends('layouts.master')
@section('title', '- Utilisateurs')
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
                                    @if(CheckOptionsPermission('add_users'))
                                        <button class="btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" data-target="#newUserForm" data-toggle="modal">
                                            <i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="newuser">New user</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="action-filters row">
                                <div class="dataTables_length" id="DataTables_Table_0_length">
                                    @if($SearchFieldMode)
                                        <a href="/users" class="btn btn-danger" id="DeleteFiltrebtn">
                                            <i class="fa fa-times-circle" style="margin-right:5px"></i><span data-i18n="deletefiltre">Supprimer le filtre</span>
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
                                    <th data-i18n="username">Username</th>
                                    <th data-i18n="rule">Rule</th>
                                    <th data-i18n="siegecp">Head office</th>
                                    <th data-i18n="etat">State</th>
                                    <th data-i18n="lastconnection" width="20%">Last connexion</th>
                                    <th data-i18n="datecreationsiege" width="20%">Date de creation</th>
                                    <th width="15%">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($Users as $User)
                                <tr class="{{($User->id == 1) ? 'table-dark' : ''}}">
                                    <td hidden></td>
                                    <td class="user-name">{{$User->username}}</td>

                                     
                                    <td>
                                        <div @if ($User->userRule->id == 1) class="chip chip-danger" @elseif ($User->userRule->id == 2) class="chip chip-warning" @else class="chip chip-primary" @endif >
                                            <div class="chip-body">
                                                <div class="chip-text">{{$User->userRule->rule}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="user-price">{{$User->userCompany->name ?? ''}}</td>
                                    <td>
                                        @if ($User->active == 1 )
                                        <div class="chip chip-success"><div class="chip-body"><div class="chip-text" data-i18n="active">Enabled</div></div></div>
                                        @else
                                        <div class="chip chip-danger"><div class="chip-body"><div class="chip-text" data-i18n="disabled">Disabled</div></div></div>
                                        @endif
                                    </td>
                                    <td>{{$User->last_connection ?? '---'}}</td>
                                    <td>{{$User->created_at}}</td>

                                    <td class="user-action">
                                        <button class="btn p-1 btn-primary" tabindex="0" aria-controls="DataTables_Table_0" id="updateUserFormbtn" data-user-id="{{$User->id}}" data-target="#updateUserForm" data-toggle="modal">
                                            <span><i class="feather icon-edit"></i></span>
                                        </button>
                                        @if(CheckOptionsPermission('delete_users'))
                                            <button class="btn p-1 btn-danger" data-user-id="{{$User->id}}" id="DeleteUser">
                                                <span class="action-delete"><i class="feather icon-trash"></i></span>
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


                    @if(CheckOptionsPermission('add_users'))
                    <!-- Modal -->                    
                        <div class="modal fade text-left horizontal-menu-wrapper" id="newUserForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17" data-i18n="newuser">Nouvel Utilisateur</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="/users/add">
                                            <div class="modal-body">
                                                <div class="data-items pb-3 ps">
                                                            <div class="data-fields px-2 mt-3">
                                                            {{ @csrf_field() }}
                                                                <div class="row">
                                                                    <div class="col-sm-6 data-field-col">
                                                                        <label for="lastname" data-i18n="name">Lastname</label>
                                                                        <input name="lastname" type="text" class="form-control" id="lastname"><br>
                                                                    </div>
                                                                    <div class="col-sm-6 data-field-col">
                                                                        <label for="firstname" data-i18n="prenom">Firstname</label>
                                                                        <input name="firstname" type="text" class="form-control" id="firstname"><br>
                                                                    </div>
                                                                    <div class="col-sm-12 data-field-col">
                                                                        <label for="email">Email</label>
                                                                        <input name="email" type="email" class="form-control" id="email"><br>
                                                                    </div>
                                                                    
                                                                    <div class="col-sm-6 data-field-col">
                                                                        <label for="username" data-i18n="username">Username</label>
                                                                        <input name="username" type="text" class="form-control" id="username" readonly="readonly"><br>
                                                                    </div>
                                                                    <div class="col-sm-6 data-field-col">
                                                                        <label for="password" data-i18n="password">Password</label>
                                                                        <input name="password" type="password" class="form-control" id="password"><br>
                                                                    </div>
                                                                    <div class="col-sm-6 data-field-col rules">
                                                                        <label for="rule" data-i18n="rule">Rule</label>
                                                                        <select name="rule" class="form-control" id="rule">
                                                                            @foreach($Rules as $Rule) 
                                                                                <option value="{{$Rule->id}}" class="admin">{{$Rule->rule}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6 data-field-col companies">
                                                                        <label for="companies" data-i18n="siegecp"> Head office </label>
                                                                        <select name="companies" class="form-control" id="companies">
                                                                            @foreach($mainCompany as $mc) 
                                                                                <option value="{{$mc->id}}" class="admin">{{$mc->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6 data-field-col form-check mt-2">
                                                                        <div class="text-left">
                                                                            <fieldset class="checkbox">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <input type="checkbox" name="active" id="active" >
                                                                                    <span class="vs-checkbox">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="">Actif</span>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                        </div>
                                                        <div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span  data-i18n="add">Add</span></button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- update Modal -->
                    <div class="modal fade text-left horizontal-menu-wrapper" id="updateUserForm" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="updateModalLabel" data-i18n="UpdateUSR">Update user informations</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/users/edit">
                                        <div class="modal-body">
                                            <div class="data-items pb-3 ps">
                                                        <div class="data-fields px-2 mt-3">
                                                        {{ @csrf_field() }}
                                                            <div class="row">
                                                            <input type="hidden" name="user_id" id="user_id">
                                                                <div class="col-sm-6 data-field-col">
                                                                    <label for="edit_lastname" data-i18n="name">Lastname</label>
                                                                    <input name="edit_lastname" type="text" class="form-control" id="edit_lastname"><br>
                                                                </div>
                                                                <div class="col-sm-6 data-field-col">
                                                                    <label for="edit_firstname" data-i18n="prenom">Firstname</label>
                                                                    <input name="edit_firstname" type="text" class="form-control" id="edit_firstname"><br>
                                                                </div>
                                                                <div class="col-sm-12 data-field-col">
                                                                    <label for="edit_email">Email</label>
                                                                    <input name="edit_email" type="email" class="form-control" id="edit_email"><br>
                                                                </div>
                                                                <div class="col-sm-6 data-field-col">
                                                                    <label for="edit_username" data-i18n="username">User name</label>
                                                                    <input name="edit_username" type="text" class="form-control" id="edit_username" readonly="readonly"><br>
                                                                </div>
                                                                <div class="col-sm-6 data-field-col">
                                                                    <label for="edit_password" data-i18n="password">Password</label>
                                                                    <input name="edit_password" type="password" class="form-control" id="edit_password"><br>
                                                                </div>
                                                                <div class="col-sm-6 data-field-col rules">
                                                                    <label for="edit_rule" data-i18n="rule">Rule</label>
                                                                    <select name="edit_rule" class="form-control" id="edit_rule">
                                                                            @foreach($Rules as $Rule) 
                                                                                <option value="{{$Rule->id}}" class="admin">{{$Rule->rule}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                </div>
                                                                <div class="col-sm-6 data-field-col companies">
                                                                    <label for="edit_companies" data-i18n="siegecp"> Head office </label>
                                                                    <select name="edit_companies" class="form-control" id="edit_companies">
                                                                            @foreach($mainCompany as $mc) 
                                                                                <option value="{{$mc->id}}" class="admin">{{$mc->name}}</option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 data-field-col form-check mt-2">
                                                                    <div class="text-left">
                                                                        <fieldset class="checkbox">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <input type="checkbox" name="edit_active" id="edit_active">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                                <span class="">Actif</span>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            @if(CheckOptionsPermission('edit_users'))
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle" style="margin-right:5px"></i><span data-i18n="update">Update</span></button>
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
@include('includes.users')