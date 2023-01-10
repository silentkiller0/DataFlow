@extends('layouts.master')
@section('title', '- Partners')
@include('layouts.OptionsPermissions')
@section('content')
    <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper mt-0">
            <div class="content-body">
                <!-- Data list -->
                <section id="data-list-view" class="data-list-view-header horizontal-menu-wrapper">
                    <div class="table-responsive" style="overflow-x: none!important;">
                        <div class="top">
                            <div class="actions action-btns mt-0">
                                <div class="dt-buttons btn-group">
                                    @if(CheckOptionsPermission('add_partners'))
                                        <button class="btn btn-primary" id="newPartnerModalBtn" tabindex="0" aria-controls="DataTables_Table_0" data-target="#newPartnerModal" data-toggle="modal">
                                            <i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="addpartner">New partner</span>
                                        </button> 
                                    @endif
                                </div>
                                @if(CheckOptionsPermission('import_partners'))
                                    <div class="dt-buttons btn-group" style="margin-left:10px">
                                        <button class="btn btn-primary" id="ImportPartnersBtn" tabindex="0" aria-controls="DataTables_Table_0" data-target="#ImportPartnersModal" data-toggle="modal">
                                            <i class="fa fa-files-o" style="margin-right:5px"></i><span data-i18n="importpartners">Import partners</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="action-filters row">
                                <div class="dataTables_length" id="DataTables_Table_0_length">
                                    @if($SearchFieldMode)
                                        <a href="/partners" class="btn btn-danger" id="DeleteFiltrebtn">
                                            <i class="fa fa-times-circle" style="margin-right:5px"></i><span data-i18n="deletefiltre">Supprimer le filtre</span>
                                        </a>
                                    @endif
                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <label>
                                            <input value="{{$SearchField ?? ''}}"  placeholder="EDI identification" type="text" class="form-control form-control-sm"  autocomplete="off" id="search" name="search">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <b style="margin-left:20px;"><?php echo "Total : ".$PartnersCount; ?> <b data-i18n="DashboardPartners">Partners</b></b>
                        {{ @csrf_field() }}
                            <table class="table data-list-view">
                                <thead>
                                    <tr width="100%">
                                        <th hidden></th>
                                        <th style="width:25%" data-i18n="nompartner">Partner name</th>
                                        <th style="width:20%" data-i18n="glnpartner">GLN</th>
                                        <th style="width:20%" data-i18n="company">Company</th>
                                        <th style="width:20%" data-i18n="datecreationsiege">Creation date</th>
                                        <th style="width:15%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($partners as $partner)
                                    <tr data-company-id="{{$partner->id}}">
                                        <td hidden></td>
                                        <td style="font-size:13px" class="product-name">{{$partner->name}}</td>
                                        <td style="font-size:13px" class="product-gln">{{$partner->gln}}</td>
                                        <td style="font-size:13px" class="product-gln">{{$partner->partnerCompany->name}}</td>
                                        <td style="font-size:13px" class="product-createdat">{{$partner->created_at}}</td>
                                        <td style="font-size:13px" class="product-action">
                                            <button class="btn p-1  btn-primary" id="EditPartnerModalbtn" tabindex="0" aria-controls="DataTables_Table_0" data-target="#EditPartnerModal" data-partner-id="{{$partner->id}}" data-toggle="modal">
                                                <span><i class="feather icon-edit"></i></span>
                                            </button> 
                                        @if(CheckOptionsPermission('delete_partners'))
                                            <button class="btn p-1 btn-danger" data-partner-id="{{$partner->id}}" id="DeletePartner">
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
                                    @if($partners->count() >= 20)
                                        <li class="paginate_button page-item previous" id="DataTables_Table_0_previous">
                                            <a href="{{$partners->previousPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                            <a href="{{$partners->nextPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                @if(CheckOptionsPermission('import_partners'))
                    <!-- Modal Importation des partners -->
                    <div class="modal fade text-left horizontal-menu-wrapper" id="ImportPartnersModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17" data-i18n="importtitle">Import partners</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="data-items">
                                            <div class="data-fields">
                                                <div class="alert alert-primary" style="background-color:#AAD0D2 !important">
                                                    <b style="color:#000" data-i18n="modelimport">Import model :</b><br><br>
                                                    <p data-i18n="importtxt">
                                                        The partner import template contains 4 columns:<br>
                                                        (<b>Partner Name, GLN, Address, Comment</b>).<br>
                                                    <p>
                                                    <b style="color:red" data-i18n="importtxt2">NB: lines with duplicate GLNs will not be taken into account.</b><br><br>
                                                    <b data-i18n="importtxt3"><a href="/models/Import_Partners.xlsx" style="color:#000"> >> Download import model << </a></b>

                                                    <
                                                </div>
                                                <div class="alert alert-primary" style="background-color:#AAD0D2 !important">
                                                    <b style="color:#000" data-i18n="importtxt4">Import partners :</b><br><br>
                                                    <p data-i18n="importtxt5">Select the company you want to link with your list, to select your Excel file of partners respecting the predefined model above, then start the import.</p><br>
                                                    <form action="/partners/import" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="company_id" data-i18n="company"> Company </label>
                                                                <select class="form-control" id="company_id" name="company_id">
                                                                    @foreach($Company as $companie) 
                                                                        <option value="{{$companie->id}}">{{$companie->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="file" data-i18n="file"> File </label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="file" name="file">
                                                                    <label class="custom-file-label" for="inputGroupFile01" data-i18n="selectimport">Select an Excel file</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" style="margin-top:20px">
                                                                <button type="submit" class="btn btn-primary" style="width:100%">
                                                                    <i class="fa fa-files-o" style="margin-right:5px"></i><span data-i18n="startimport">Lunch the importation</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(CheckOptionsPermission('add_partners'))
                    <!-- Modal Creation du partner -->
                    <div class="modal fade text-left horizontal-menu-wrapper" id="newPartnerModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17" data-i18n="addpartner">New partner</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/partners/add">
                                            <div class="modal-body">
                                                <div class="data-items">
                                                            <div class="data-fields">
                                                                    {{ @csrf_field() }}
                                                                    <div class="row">
                                                                        <div class="col-sm-6 data-field-col">
                                                                            <label for="data-name" data-i18n="nompartner">Partner name</label>
                                                                            <input name="name" type="text" class="form-control" id="name"><br>
                                                                        </div>
                                                                        <div class="col-sm-6 data-field-col">
                                                                            <label for="data-gln" data-i18n="glnpartner">GLN</label>
                                                                            <input name="gln" type="text" class="form-control" id="gln" placeholder="EAN13"><br>
                                                                        </div>
                                                                        <div class="col-sm-12 data-field-col">
                                                                            <label for="data-adresse" data-i18n="adr">Address</label>
                                                                            <input name="adresse" type="text" class="form-control" id="adresse" placeholder="Adresse"><br>
                                                                        </div>
                                                                        @if(Auth::user()->id == 1)
                                                                            <div class="col-sm-12 data-field-col">
                                                                                <label for="companie" data-i18n="company">Company</label>
                                                                                <select name="companie" class="form-control" id="companie">
                                                                                    @foreach($Company as $cmp) 
                                                                                        <option value="{{$cmp->id}}" class="admin">{{$cmp->name}}</option>
                                                                                    @endforeach
                                                                                </select><br>
                                                                            </div>
                                                                        @endif
                                                                        <div class="col-sm-12 data-field-col">
                                                                            <label for="data-description">Comment</label>
                                                                            <textarea name="description" type="description" class="form-control" id="description"></textarea><br>
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
                                                <button type="submit" class="btn btn-primary" id="AddPartner"><i class="fa fa-plus-circle" style="margin-right:5px"></i><span data-i18n="add">Ajouter</span></button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Annuler</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                    <!-- Modal Update partner-->
                    <div class="modal fade text-left horizontal-menu-wrapper" id="EditPartnerModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17" data-i18n="UpdatePAR">Update partner informations</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="/partners/edit">
                                            <div class="modal-body">
                                                <div class="data-items pb-3 ps">
                                                            <div class="data-fields px-2 mt-3">
                                                                    {{ @csrf_field() }}
                                                                    <div class="row">
                                                                        <input type="hidden" name="partner_id" id="partner_id">
                                                                        <div class="col-sm-6 data-field-col">
                                                                            <label for="data-name" data-i18n="nompartner">Partner name</label>
                                                                            <input name="edit_name" type="text" class="form-control" id="edit_name"><br>
                                                                        </div>
                                                                        <div class="col-sm-6 data-field-col">
                                                                            <label for="data-gln" data-i18n="glnpartner">GLN</label>
                                                                            <input name="edit_gln" type="text" class="form-control" id="edit_gln" placeholder="EAN13"><br>
                                                                        </div>
                                                                        <div class="col-sm-12 data-field-col">
                                                                            <label for="data-adresse" data-i18n="adr">Address</label>
                                                                            <input name="edit_adresse" type="text" class="form-control" id="edit_adresse" placeholder="Adresse"><br>
                                                                        </div>
                                                                        @if(Auth::user()->id == 1)
                                                                            <div class="col-sm-12 data-field-col">
                                                                                <label for="data-companie" data-i18n="company">Companies</label>
                                                                                <select name="edit_companie" class="form-control" id="edit_companie">
                                                                                    @foreach($Company as $cmp) 
                                                                                        <option value="{{$cmp->id}}" class="admin">{{$cmp->name}}</option>
                                                                                    @endforeach
                                                                                </select><br>
                                                                            </div>
                                                                        @endif
                                                                        <div class="col-sm-12 data-field-col">
                                                                            <label for="data-description">Comment</label>
                                                                            <textarea name="edit_description" type="description" class="form-control" id="edit_description"></textarea><br>
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
                                            @if(CheckOptionsPermission('edit_partners'))
                                                <button type="submit" class="btn btn-primary" id="EditPartner"><i class="fa fa-check-circle" style="margin-right:5px"></i><span data-i18n="update">Mettre à jour</span></button>
                                            @endif    
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-i18n="Cancel">Annuler</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
        </div>
    </div>
@endsection
@include('includes.partners')

