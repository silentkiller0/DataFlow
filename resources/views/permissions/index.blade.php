@extends('layouts.master')
@section('title', '- Rôle et Permissions')

@section('content')

            <section class="horizontal-menu-wrapper">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12 d-flex align-items-stretch">
                            <div class="card" style="width:100%">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25" data-i18n="usersrules">Users rules</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <button data-toggle="modal" data-target="#AddRole" class="btn btn-primary float-right btn-inline" style="width:100%"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="addrule">Add new rule</span></button><br>
                                    </div>
                                    <div class="table-responsive"  style="padding: 20px">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($Rules as $Rule) 
                                                    <tr>
                                                        <th scope="row">{{$Rule->rule}}</th>
                                                        <th>
                                                        @if ($Rule->can_be_edited == 0)
                                                            <button class="btn-icon btn btn-secondary btn-round float-right btn-inline"><i class="fa fa-times"></i></button>
                                                        @else    
                                                            <button class="btn-icon btn btn-danger btn-round float-right btn-inline" id="DeleteRule" data-id="{{$Rule->id}}"><i class="fa fa-times"></i></button>
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


                        <div class="col-lg-8 col-md-12 col-12 d-flex align-items-stretch">
                            <div class="card" style="width:100%">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <h2 class="text-bold-700 mt-1 mb-25" data-i18n="permissiongenerale">General permissions</h2>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <button data-toggle="modal" data-target="#AddDocumentType" class="btn btn-primary float-right btn-inline" style="width:100%" aria-controls="DataTables_Table_0"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="addpermission">Add new permission</span></button><br>
                                    </div>
                                    <div class="table-responsive"  style="padding: 20px">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Display name</th>
                                                    <th>Refrence</th>
                                                    <th class="float-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($Permissions as $Permission) 
                                                    <tr>
                                                    <th scope="row">{{$Permission->display_name}}</th>
                                                    <th scope="row">{{$Permission->name}}</th>
                                                        <th>
                                                        @if ($Permission->can_be_edited == 0)
                                                            <button class="btn-icon btn btn-secondary btn-round float-right btn-inline" type="button" ><i class="fa fa-times"></i></button>
                                                        @else
                                                            <button class="btn-icon btn btn-danger btn-round float-right btn-inline" id="DeletePermission" data-id="{{$Permission->id}}"><i class="fa fa-times"></i></button>
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


                            <!-- Modal : Rôles -->
                            <div class="modal fade text-left horizontal-menu-wrapper" id="AddRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel18" data-i18n="rule">Rule</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <form id="AddRole" method="POST" action="/permissions/role/add">
                                                {{ @csrf_field() }}
                                                <div class="modal-body">
                                                    <p data-i18n="addrule">
                                                    Add new rule
                                                    </p>
                                                    <fieldset class="form-group">
                                                        <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Ex : manager">
                                                    </fieldset>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="AddRole"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="add">Add</span></button>
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
                                            <h4 class="modal-title" id="myModalLabel18" data-i18n="permissiongenerale">General permissions</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="/permissions/perm/add">
                                            {{ @csrf_field() }}
                                            <div class="modal-body">
                                                <p data-i18n="addpermission">
                                                    Add new permission
                                                </p>
                                                <fieldset class="form-group">
                                                    <span>Display name</span>
                                                    <input type="text" id="display_name" name="display_name" class="form-control" placeholder="Ex : Download PDF">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <span>Reference</span>
                                                    <input type="text" id="name" name="name" class="form-control" readonly="readonly">
                                                </fieldset>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="add">Add</span></button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Annuler</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



@endsection
@include('includes.permissions')