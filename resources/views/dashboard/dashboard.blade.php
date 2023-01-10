@extends('layouts.master')
@section('title', '- Dashboard')
@include('layouts.OptionsPermissions')
@section('content')

        <section class="horizontal-menu-wrapper" id="dashboard-analytics">
                    <div class="row row-cols-2 match-height">
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="card bg-analytics text-white">
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <img src="../../../app-assets/images/elements/decore-left.png" class="img-left" alt="card-img-left">
                                        <img src="../../../app-assets/images/elements/decore-right.png" class="img-right" alt="card-img-right">
                                        <div class="avatar avatar-xl bg-primary shadow mt-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-award white font-large-1"></i>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="mb-2 text-white card-text"><span data-i18n="WelcomeMessage">Welcome back,</span> {{Auth::user()->lastname}}</h1>
                                            <p class="m-auto w-75" data-i18n="WelcomeSubMessage">Here are some real-time numbers of your flows</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card text-black" style="background-color: #fff !important">
                                <div class="card-content justify-content-between">
                                    <div class="card-body text-center">

                                        <div class="text-center" >
                                        <img src="imgs/support.png" class="img-center" alt="card-img-center" style="width:50%">
                                            <p data-i18n="Documentations">Voir notre manuelle d'utilisation</p>
                                            <div class="btn btn-outline-primary" id="tour">Start Tour</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row row-cols-2">
                        <!-- Statistiques du flux commandes -->
                        @if(CheckOptionsPermission('view_orders'))
                            <div class="col">
                                <a href="/flux/orders">
                                    <div class="card" class="StatsOrders">
                                        <div class="card-header d-flex align-items-start pb-0">
                                            <div>
                                                <h2 class="text-bold-700" id="OrdersCount">{{$OrdersCount}}</h2>
                                                <p class="mb-0" data-i18n="AnalyticsOrdersCount">Total des flux commandes</p>
                                            </div>
                                            <div class="avatar bg-rgba-primary p-50">
                                                <div class="avatar-content">
                                                    <i class="fa fa-files-o text-primary font-medium-5"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div id="CommandesChart-area"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card">
                                                    <div class="card-header d-flex align-items-start pb-0">
                                                        <div>
                                                            <h2 class="text-bold-700 mb-0">{{$OrdersErrorsCount}}</h2>
                                                            <p data-i18n="AnalyticsOrdersError">Commandes en erreur</p>
                                                        </div>
                                                        <div class="avatar bg-rgba-danger p-50 m-0">
                                                            <div class="avatar-content">
                                                                <i class="feather icon-alert-circle text-danger font-medium-5"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header d-flex align-items-start pb-0">
                                                    <div>
                                                        <h2 class="text-bold-700 mb-0">{{$OrdersSuccessCount}}</h2>
                                                        <p data-i18n="AnalyticsOrdersSuccess">Commandes conformes</p>
                                                    </div>
                                                    <div class="avatar bg-rgba-success p-50 m-0">
                                                        <div class="avatar-content">
                                                            <i class="feather icon-check-circle text-success font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        <!-- Statistiques du flux invoices -->
                        @if(CheckOptionsPermission('view_invoices'))
                            <div class="col">
                                <a href="/flux/invoices">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-start pb-0">
                                            <div>
                                                <h2 class="text-bold-700">{{$InvoicesCount}}</h2>
                                                <p class="mb-0" data-i18n="AnalyticsInvoicesCount">Total des flux factures</p>
                                            </div>
                                            <div class="avatar bg-rgba-primary p-50">
                                                <div class="avatar-content">
                                                    <i class="fa fa-files-o font-medium-5" style="color:#2CD4B1 !important;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div id="FacturesChart-area"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card">
                                                    <div class="card-header d-flex align-items-start pb-0">
                                                        <div>
                                                            <h2 class="text-bold-700 mb-0">{{$InvoicesErrorsCount}}</h2>
                                                            <p data-i18n="AnalyticsInvoicesError">Factures en erreur</p>
                                                        </div>
                                                        <div class="avatar bg-rgba-danger p-50 m-0">
                                                            <div class="avatar-content">
                                                                <i class="feather icon-alert-circle text-danger font-medium-5"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header d-flex align-items-start pb-0">
                                                    <div>
                                                        <h2 class="text-bold-700 mb-0">{{$InvoicesSuccessCount}}</h2>
                                                        <p data-i18n="AnalyticsInvoicesSuccess">Factures conformes</p>
                                                    </div>
                                                    <div class="avatar bg-rgba-success p-50 m-0">
                                                        <div class="avatar-content">
                                                            <i class="feather icon-check-circle text-success font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        <!-- Statistiques du flux desadv -->
                        @if(CheckOptionsPermission('view_desadv'))
                            <div class="col">
                                <a href="/flux/desadv">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-start pb-0">
                                            <div>
                                                <h2 class="text-bold-700">{{$DesadvCount}}</h2>
                                                <p class="mb-0" data-i18n="AnalyticsDesadvCount">Total des flux Desadv</p>
                                            </div>
                                            <div class="avatar bg-rgba-primary p-50">
                                                <div class="avatar-content">
                                                    <i class="fa fa-files-o font-medium-5" style="color:#000 !important;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div id="DesadvChart-area"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card">
                                                    <div class="card-header d-flex align-items-start pb-0">
                                                        <div>
                                                            <h2 class="text-bold-700 mb-0">{{$DesadvErrorsCount}}</h2>
                                                            <p data-i18n="AnalyticsDesadvError">Desadv en erreur</p>
                                                        </div>
                                                        <div class="avatar bg-rgba-danger p-50 m-0">
                                                            <div class="avatar-content">
                                                                <i class="feather icon-alert-circle text-danger font-medium-5"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header d-flex align-items-start pb-0">
                                                    <div>
                                                        <h2 class="text-bold-700 mb-0">{{$DesadvSuccessCount}}</h2>
                                                        <p data-i18n="AnalyticsDesadvSuccess">Desadv conformes</p>
                                                    </div>
                                                    <div class="avatar bg-rgba-success p-50 m-0">
                                                        <div class="avatar-content">
                                                            <i class="feather icon-check-circle text-success font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>


                    <div class="row row-cols-2 match-height">
                        @if(CheckOptionsPermission('view_partners') && CheckOptionsPermission('view_societies') & CheckOptionsPermission('view_main_company'))
                            <div class="col">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between pb-0">
                                        <h4 data-i18n="DashboardCompanies">Companies</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div id="EntreprisesChart-area" class="mb-3"></div>
                                            <a href="/MainCompany">
                                                <div class="chart-info d-flex justify-content-between mb-1">
                                                    <div class="series-info d-flex align-items-center">
                                                        <i class="fa fa-circle-o text-bold-700" style="color: #084a4e !important;"></i>
                                                        <span class="text-bold-600 ml-50" data-i18n="DashboardMainCompanies">Head office</span>
                                                    </div>
                                                    <div class="product-result">
                                                        <span id="mainCompaniesCount">{{$mainCompaniesCount}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/societies">
                                                <div class="chart-info d-flex justify-content-between mb-1">
                                                    <div class="series-info d-flex align-items-center">
                                                        <i class="fa fa-circle-o text-bold-700" style="color: #2CD4B1 !important;"></i>
                                                        <span class="text-bold-600 ml-50" data-i18n="DashboardCompanies">Companies</span>
                                                    </div>
                                                    <div class="product-result">
                                                        <span id="CompaniesCount">{{$CompaniesCount}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/partners">
                                                <div class="chart-info d-flex justify-content-between mb-75">
                                                    <div class="series-info d-flex align-items-center">
                                                        <i class="fa fa-circle-o text-bold-700" style="color: #000 !important;"></i>
                                                        <span class="text-bold-600 ml-50" data-i18n="DashboardPartners">Partners</span>
                                                    </div>
                                                    <div class="product-result">
                                                        <span id="PartnersCount">{{$PartnersCount}}</span>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(CheckOptionsPermission('view_users'))
                            <div class="col">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between pb-0">
                                        <h4 data-i18n="Users">Users</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div id="UsersChart-area" class="mb-3"></div>
                                            <a href="/users">
                                                <div class="chart-info d-flex justify-content-between mb-1">
                                                    <div class="series-info d-flex align-items-center">
                                                        <i class="fa fa-circle-o text-success text-bold-700"></i>
                                                        <span class="text-bold-600 ml-50" data-i18n="UsersActive">Users activated</span>
                                                    </div>
                                                    <div class="product-result">
                                                        <span id="UsersActiveCount">{{$UsersActiveCount}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/users">
                                                <div class="chart-info d-flex justify-content-between mb-1">
                                                    <div class="series-info d-flex align-items-center">
                                                        <i class="fa fa-circle-o text-danger text-bold-700"></i>
                                                        <span class="text-bold-600 ml-50" data-i18n="UsersDesactive">Users disabled</span>
                                                    </div>
                                                    <div class="product-result">
                                                        <span id="UsersDesactiveCount">{{$UsersDesactiveCount}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
@endsection
@push('js')
<script type="module">window.onload = function() {$("#view_dashboard").addClass("active");}</script>