@extends('layouts.master')
@section('title', '- Flux')
@include('layouts.OptionsPermissions')
@section('content')
    <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper mt-0">
            <div class="content-body">
                <!-- Data list -->
                <section id="data-list-view" class="data-list-view-header horizontal-menu-wrapper" style="margin-left:-40px">
                    <div class="table-responsive" style="overflow-x: none!important">
                        <div class="top">
                            <!--<div class="actions action-btns mt-0"></div>-->
                            <div class="action-filters" style="width: 100% !important;">
                                <div class="dataTables_length" id="DataTables_Table_0_length" style="width: 100% !important;">
                                    <div id="DataTables_Table_0_filter">

                                    <div class="alert mt-1" style="padding-top:10px;padding-top:15px;background: linear-gradient(183deg, rgba(197,231,232,1) 0%, rgba(25,89,93,0.90) 100%);">
                                        <form action="/flux/search/desadv" method="post">
                                            {{ @csrf_field() }}
                                            <div class="row">
                                                @if(Auth::id() == 1)
                                                    <div class="col data-field-col">
                                                        <label for="syslog_id" style="font-size:9px;color:#fff">Syslog ID</label>
                                                        <input style="width:110% !important" placeholder="0000" type="text" class="form-control"  autocomplete="off" id="syslog_id" name="syslog_id">
                                                    </div>
                                                @endif
                                                <div class="col data-field-col">
                                                    <label for="ref_desadv" style="font-size:9px;color:#fff" data-i18n="refDESADV">R??f dESADV</label>
                                                    <input style="width:110% !important" placeholder="FC001" type="text" class="form-control"  autocomplete="off" id="ref_desadv" name="ref_desadv">
                                                </div>
                                                <div class="col data-field-col">
                                                    <label for="date_desadv" style="font-size:9px;color:#fff" data-i18n="Daterecdesadv">Date recep desadv</label>
                                                    <input style="margin-right:-20px;width:100% !important" type="date" class="form-control"  autocomplete="off" id="date_desadv" name="date_desadv">
                                                </div>
                                                
                                                <div class="col data-field-col">
                                                    <label for="ref_commande" style="font-size:9px;color:#fff" data-i18n="refCommande">R??f Commande</label>
                                                    <input style="margin-right:-20px;width:110% !important" placeholder="CM001" type="text" class="form-control"  autocomplete="off" id="ref_commande" name="ref_commande">
                                                </div>
                                                <div class="col data-field-col">
                                                    <label for="date_commande" style="font-size:9px;color:#fff" data-i18n="DateCommande">Date Commande</label>
                                                    <input style="margin-right:-20px;width:100% !important" type="date" class="form-control"  autocomplete="off" id="date_commande" name="date_commande">
                                                </div>
                                                <div class="col data-field-col">
                                                    <label for="gln_client" style="font-size:9px;color:#fff" data-i18n="GLNClient">GLN Client</label>
                                                    <input maxlength="13" style="margin-right:-20px;width:120% !important;"  placeholder="EAN13" type="text" class="form-control"  autocomplete="off" id="gln_client" name="gln_client">
                                                </div>
                                                <div class="col data-field-col">
                                                    <label for="gln_fournisseur" style="font-size:9px;color:#fff" data-i18n="GLNfrs">GLN Fournisseur</label>
                                                    <input style="margin-right:-20px;width:110% !important" placeholder="EAN13" type="text" class="form-control"  autocomplete="off" id="gln_fournisseur" name="gln_fournisseur">
                                                </div>
                                                <div class="col data-field-col">
                                                    <label for="status_id" style="font-size:9px;color:#fff">Status EDI</label>
                                                    <select style="width:100% !important" placeholder="Status EDI" type="text" class="form-control"  autocomplete="off" id="status_id" name="status_id">
                                                        <option value="" class="admin">----</option>
                                                        @foreach($FluxStatus as $flux) 
                                                            <option value="{{$flux->id}}" class="admin">{{$flux->status}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col data-field-co" style="margin-right:10px;"><br>
                                                    <button  type="submit" class="btn p-1 btn-primary" style="height:60%;width:100% !important">
                                                        <i class="feather icon-search" ></i>
                                                    </button> 
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ @csrf_field() }}
                            <table class="table data-list-view" style="width:100% !important">
                                <thead>
                                    <tr width="100%">
                                        <th hidden></th>
                                        @if(Auth::id() == 1)<th>Syslog ID</th>@endif
                                        <th data-i18n="refDESADV">Ref Desadv</th>
                                        <th data-i18n="Daterecdesadv">Date recep Desadv</th>
                                        <th data-i18n="refCommande">Ref Order</th>
                                        <th data-i18n="DateCommande">Order Date</th>
                                        <th data-i18n="GLNClient">GLN Customer</th>
                                        <th data-i18n="GLNfrs">GLN Supplier</th>
                                        <th>Status EDI</th>
                                        <th width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>



                                @foreach($desadv as $bl)
                                    <tr data-company-id="{{$bl->id}}">
                                        <th hidden></th>
                                        @if(Auth::id() == 1)<td>{{$bl->syslog_id ?? '---'}}</td>@endif
                                        <td><div class="chip chip-primary"><div class="chip-body"><div class="chip-text">{{$bl->ref_desadv  ?? '---'}}</div></div></div></td>
                                        <td>{{$bl->date_reception_desadv  ?? '---'}}</td>
                                        <td>{{$bl->ref_order  ?? '---'}}</td>
                                        <td>{{$bl->date_order  ?? '---'}}</td>
                                        <td>{{$bl->gln_client  ?? '---'}}</td>
                                        <td>{{$bl->gln_fournisseur  ?? '---'}}</td>
                                        <td><div class="chip" style="background-color:{{$bl->fluxStatus->color ?? 'gray'}}"><div class="chip-body"><div class="chip-text text-white">{{$bl->fluxStatus->status ?? '------'}}</div></div></div></td>
                                        <td> 
                                            <button class="btn p-1 btn-primary" data-bl-id="{{$bl->id}}" id="ShowBl" data-target="#ShowDESADVModal" data-toggle="modal">
                                                <span class=""><i class="feather icon-eye"></i></span>
                                            </button> 
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        <div class="bottom">
                            <div class="actions"></div>
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    @if($desadv->count() == 20)
                                        <li class="paginate_button page-item previous" id="DataTables_Table_0_previous">
                                            <a href="{{$desadv->previousPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                        </li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                            <a href="{{$desadv->nextPageUrl()}}" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>


                    

                    <!-- Modal Show Desadv -->
                    <div class="modal fade text-left" id="ShowDESADVModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" data-i18n="DESADVModalTitle">DESADV Informations</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                            <div class="modal-body" style="margin-top:-40px">
                                                <div class="data-items">
                                                    <div class="data-fields px-2 mt-3">
                                                        
                                                        <div class="alert alert-primary" style="background-color:#53878A !important">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <span style="color:#fff;font-size:20px" data-i18n="DESADVnb">DESADV N?? </span><span id="ref_desadv" style="color:#fff;font-style:bold;font-size:25px"></span><br>
                                                                </div>
                                                                <div class="col-md-2" style="padding-top:3px">
                                                                    <span id="status_id"></span>
                                                                </div>

                                                                <div class="col-md-12" style="margin-top:10px">
                                                                    <table>
                                                                        <tr style="width:100%">
                                                                            <td style="width:40%"><span style="font-size:13px;color:#d3d3d3;margin-right:30px" data-i18n="DateDoc">Dcoument date : </span></td>
                                                                            <td style="width:60%"><span style="font-size:13px;color:#e9e9e9" id="date_document"></span></td>
                                                                        </tr>
                                                                        <tr style="width:100%">
                                                                            <td style="width:40%"><span style="font-size:13px;color:#d3d3d3;margin-right:30px" data-i18n="Nomfr">Supplier name : </span></td>
                                                                            <td style="width:60%"><span style="font-size:13px;color:#e9e9e9" id="nom_fournisseur"></span></td>
                                                                        </tr>
                                                                        <tr style="width:100%">
                                                                            <td style="width:40%"><span style="font-size:13px;color:#d3d3d3;margin-right:30px" data-i18n="AdrGLNFRS">Supplier GLN : </span></td>
                                                                            <td style="width:60%"><span style="font-size:13px;color:#e9e9e9" id="gln_fournisseur"></span></td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 d-flex align-items-stretch" style="display: flex;">
                                                                    <div class="alert alert-primary" style="background-color:#AAD0D2 !important;width:100% !important;position: relative;display : table;">
                                                                    <b>Details de livraison :</b><br><br>
                                                                            <table style="margin-bottom:10px">
                                                                                <tr style="width:100%">
                                                                                    <td style="font-size:13px;width:50%;vertical-align: top"><span style="color:#555;margin-right:30px" data-i18n="Desadvnbr">DESADV N?? </span></td>
                                                                                    <td style="font-size:13px;width:100%;vertical-align: top"><b style="color:#000" id="ref_desadv"></b></td>
                                                                                </tr>
                                                                                <tr style="width:100%">
                                                                                    <td style="font-size:13px;width:50%;vertical-align: top"><span style="color:#555;margin-right:30px" data-i18n="Dateliv">Delivery date :</span></td>
                                                                                    <td style="font-size:13px;width:100%;vertical-align: top"><span style="color:#000" id="date_livraison"></span></td>
                                                                                </tr>
                                                                                <tr style="width:100%">
                                                                                    <td style="font-size:13px;width:50%;vertical-align: top"><span style="color:#555;margin-right:30px" data-i18n="Datereception">Reception date :</span></td>
                                                                                    <td style="font-size:13px;width:100%;vertical-align: top"><span style="color:#000" id="date_reception_desadv"></span></td>
                                                                                </tr>
                                                                                <tr style="width:100%">
                                                                                    <td colspan="2" style="font-size:13px;width:50%;vertical-align: top"><span style="color:#555;margin-right:30px" data-i18n="AdrLiv">Delivery Address :</span></td>
                                                                                </tr>
                                                                                <tr style="width:100%">
                                                                                    <td colspan="2" style="font-size:13px;width:100%;vertical-align: top;padding-left:10px"><span id="adresse_livraison" style="color:#000;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 4;-webkit-box-orient: vertical;"></span></td>
                                                                                </tr>
                                                                            </table>
                                                                            <div class="col-md-12" style="display : table-row;vertical-align : bottom;height: 0px;">
                                                                            <div class="alert alert-primary" style="background-color:#e9e9e9 !important;">
                                                                                <table>
                                                                                    <tr style="width:100%">
                                                                                        <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="livrea">Delivered to</span></td>
                                                                                        <td style="font-size:13px;width:100%;vertical-align: top"><b style="color:#000" id="nom_client_livraison"></b></td>
                                                                                    </tr>
                                                                                    <tr style="width:100%">
                                                                                        <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="gln">GLN</span></td>
                                                                                        <td style="font-size:13px;width:100%;vertical-align: top"><span style="color:#3f3f3f" id="gln_livraison"></span></td>
                                                                                    </tr>
                                                                                    <tr style="width:100%">
                                                                                        <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="adr">Address</span></td>
                                                                                        <td style="font-size:13px;width:100%;vertical-align: top">
                                                                                            <span id="adr_client_livraison" style="color:#3f3f3f;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;" ></span>
                                                                                            <textarea id="adr_client_livraison_area" style="display: none;" rows="3"></textarea>
                                                                                            <a id="adr_client_livraison_btnconfirme" style="color:green;display: none;" data-bl-id="">Appliquer</a>
                                                                                            <a id="adr_client_livraison_btncancel" style="color:red;display: none;">Annuler</a>
                                                                                            <span id="gln" hidden></span>
                                                                                            <a class="adr_client_livraison_open" data-i18n="editadr" style="color:blue">(Edit address)</a>
                                                                                            <br><br>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr style="width:100%">
                                                                                        <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="siege">Head office</span></td>
                                                                                        <td style="font-size:13px;width:100%;vertical-align: top"><span style="color:#3f3f3f" id="siege_client_livraison"></span></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-stretch" style="display: flex;">
                                                                <div class="alert alert-primary" style="background-color:#AAD0D2 !important;width:100%;position: relative;display : table;">
                                                                    <b>Commande li??e ?? l'avis d'exp??dition :</b><br><br>
                                                                            <table style="margin-bottom:10px">
                                                                                <tr>
                                                                                    <td><span style="font-size:13px;color:#555" data-i18n="ORDnb">Order N?? </span></td>
                                                                                    <td><b style="font-size:13px;color:#000;margin-left:30px" id="ref_order"></b></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><span style="font-size:13px;color:#555" data-i18n="DateCommande">Order date : </span></td>
                                                                                    <td><span style="font-size:13px;color:#000;margin-left:30px" id="date_order"></span></td>
                                                                                </tr>
                                                                            </table>
                                                                            <div class="col-md-12" style="display : table-row;vertical-align : bottom;height: 0px;">
                                                                                <div class="alert alert-primary" style="background-color:#e9e9e9 !important">
                                                                                    <table>
                                                                                        <tr style="width:100%">
                                                                                            <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="cmdpar">Ordered by</span></td>
                                                                                            <td style="font-size:13px;width:100%;vertical-align: top"><b style="color:#000" id="nom_client_commande"></b></td>
                                                                                        </tr>
                                                                                        <tr style="width:100%">
                                                                                            <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="gln">GLN</span></td>
                                                                                            <td style="font-size:13px;width:100%;vertical-align: top"><span style="color:#3f3f3f" id="gln_client_commande"></span></td>
                                                                                        </tr>

                                                                                        <tr style="width:100%">
                                                                                            <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="adr">Address</span></td>
                                                                                            <td style="font-size:13px;width:100%;vertical-align: top">
                                                                                                <span id="adr_client_commande" style="color:#3f3f3f;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 6;-webkit-box-orient: vertical;" ></span>
                                                                                                <textarea id="adr_client_commande_area" style="display: none;" rows="3"></textarea>
                                                                                                <a id="adr_client_commande_btnconfirme" style="color:green;display: none;" data-bl-id="">Appliquer</a>
                                                                                                <a id="adr_client_commande_btncancel" style="color:red;display: none;">Annuler</a>
                                                                                                <span id="gln_cmd" hidden></span>
                                                                                                <a class="adr_client_commande_open" data-i18n="editadr" style="color:blue">(Edit address)</a>
                                                                                                <br><br>
                                                                                            </td>
                                                                                        </tr>

                                                                                    
                                                                                        <tr style="width:100%">
                                                                                            <td style="font-size:13px;width:48%;vertical-align: top"><span style="color:#686868;margin-right:30px" data-i18n="siege">Head office</span></td>
                                                                                            <td style="font-size:13px;width:100%;vertical-align: top"><span style="color:#3f3f3f" id="siege_client_commande"></span></td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                        

                                                        @if(CheckOptionsPermission('download_pdf_desadv'))
                                                            <button class="btn p-1 btn-danger" id="Download_file" data-type-file="pdf" data-type-data="desadv" data-toggle="tooltip" data-placement="bottom" title="PDF File">
                                                                <i style="font-size:25px" class="fa fa-file-pdf-o"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn p-1" style="background-color:#BBC4C2" data-toggle="tooltip" data-placement="bottom" title="PDF File">
                                                                <i style="font-size:25px" class="fa fa-file-pdf-o"></i>
                                                            </button>
                                                        @endif
                                                        @if(CheckOptionsPermission('download_edi_desadv'))
                                                            <button class="btn p-1 btn-primary" id="Download_file" data-type-file="edi" data-type-data="desadv" data-toggle="tooltip" data-placement="bottom" title="EDI File">
                                                                <i style="font-size:25px" class="fa fa-file-text-o"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn p-1" style="background-color:#BBC4C2" data-toggle="tooltip" data-placement="bottom" title="EDI File">
                                                                <i style="font-size:25px" class="fa fa-file-text-o"></i>
                                                            </button>
                                                        @endif
                                                        @if(CheckOptionsPermission('download_csv_desadv'))
                                                            <button class="btn p-1 btn-primary" id="Download_file" data-type-file="csv" data-type-data="desadv" data-toggle="tooltip" data-placement="bottom" title="CSV File">
                                                                <i style="font-size:25px" class="fa fa-file-excel-o"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn p-1" style="background-color:#BBC4C2" data-toggle="tooltip" data-placement="bottom" title="CSV File">
                                                                <i style="font-size:25px" class="fa fa-file-excel-o"></i>
                                                            </button>
                                                        @endif
                                                        
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
        </div>
    </div>
@endsection
@include('includes.desadv')