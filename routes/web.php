<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\FluxStatusController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserPermissionsController;
use App\Http\Controllers\FluxController;
use App\Http\Controllers\MainCompanyController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::get('/', function () {return view('home.index');});

//Dashboard
// Route::get('/dashboard', function () {return view('dashboard.dashboard');})->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, "index"])->middleware(['auth'])->name('dashboard');

//Profile
Route::get('/profile', [UsersController::class, "profile"])->middleware(['auth'])->name('profile');

//A propos
Route::get('/support', [DashboardController::class, "support"])->middleware(['auth'])->name('about');


//Users
Route::get('/users', [UsersController::class, "index"])->middleware(['checkPerms'])->name('view_users');
Route::post('/users/add', [UsersController::class, 'store'])->middleware(['checkPerms'])->name('view_users');
Route::get('/users/delete/{id}', [UsersController::class, 'destroy'])->middleware(['checkPerms'])->name('view_users');
Route::get('/users/show/{id}', [UsersController::class, 'show'])->middleware(['checkPerms'])->name('view_users');
Route::post('/users/edit', [UsersController::class, 'update'])->middleware(['checkPerms'])->name('view_users');
Route::get('/users/search/{field}', [UsersController::class, "search"])->middleware(['checkPerms'])->name('view_users');

//Societies
Route::get('/societies', [CompanyController::class, 'index'])->middleware(['checkPerms'])->name('view_societies');
Route::get('/societies/show/{id}', [CompanyController::class, 'show'])->middleware(['checkPerms'])->name('view_societies');
Route::post('/societies/edit', [CompanyController::class, 'update'])->middleware(['checkPerms'])->name('view_societies');
Route::get('/societies/delete/{id}', [CompanyController::class, 'destroy'])->middleware(['checkPerms'])->name('view_societies');
Route::post('/societies/add', [CompanyController::class, 'store'])->middleware(['checkPerms'])->name('view_societies');
Route::get('/societies/search/{field}', [CompanyController::class, "search"])->middleware(['checkPerms'])->name('view_societies');

//Maison mere
Route::get('/MainCompany', [MainCompanyController::class, 'index'])->middleware(['checkPerms'])->name('view_main_company');
Route::get('/MainCompany/search/{field}', [MainCompanyController::class, "search"])->middleware(['checkPerms'])->name('view_main_company');
Route::post('/MainCompany/add', [MainCompanyController::class, 'store'])->middleware(['checkPerms'])->name('view_main_company');
Route::post('/MainCompany/edit', [MainCompanyController::class, 'update'])->middleware(['checkPerms'])->name('view_main_company');
Route::get('/MainCompany/show/{id}', [MainCompanyController::class, 'show'])->middleware(['checkPerms'])->name('view_main_company');
Route::get('/MainCompany/delete/{id}', [MainCompanyController::class, 'destroy'])->middleware(['checkPerms'])->name('view_main_company');

//Route::post('/societies/multipleDelete', [CompanyController::class, 'multipleDelete'])->middleware(['checkPerms'])->name('view_permissions');
//Route::get('/societies/{company_id}', [CompanyController::class, 'getSocietyInfos'])->middleware(['checkPerms'])->name('view_permissions');


//Partners
Route::get('/partners', [PartnerController::class, "index"])->middleware(['checkPerms'])->name('view_partners');
Route::get('/partners/search/{field}', [PartnerController::class, "search"])->middleware(['checkPerms'])->name('view_partners');
Route::post('/partners/add', [PartnerController::class, 'store'])->middleware(['checkPerms'])->name('view_partners');
Route::get('/partners/delete/{id}', [PartnerController::class, 'destroy'])->middleware(['checkPerms'])->name('view_partners');
Route::get('/partners/show/{id}', [PartnerController::class, 'show'])->middleware(['checkPerms'])->name('view_partners');
Route::post('/partners/edit', [PartnerController::class, 'update'])->middleware(['checkPerms'])->name('view_partners');
Route::post('/partners/import', [PartnerController::class, "ImportPartnes"])->middleware(['checkPerms'])->name('import_partners');


//Configurations
Route::get('/configurations', [ConfigurationsController::class, "index"])->middleware(['checkPerms'])->name('view_configuration');
Route::post('/configurations/AddStatusFlux', [FluxStatusController::class, 'store'])->middleware(['checkPerms'])->name('view_configuration');
Route::post('/configurations/AddTransports', [TransportController::class, 'store'])->middleware(['checkPerms'])->name('view_configuration');
Route::post('/configurations/AddTypeDoc', [TypeDocumentController::class, 'store'])->middleware(['checkPerms'])->name('view_configuration');
Route::get('/configurations/DeleteStatusFlux/{id}', [FluxStatusController::class, 'destroy'])->middleware(['checkPerms'])->name('view_configuration');
Route::get('/configurations/DeleteTransport/{id}', [TransportController::class, 'destroy'])->middleware(['checkPerms'])->name('view_configuration');
Route::get('/configurations/DeleteTypeDocument/{id}', [TypeDocumentController::class, 'destroy'])->middleware(['checkPerms'])->name('view_configuration');

//Permissions
Route::get('/permissions', [ConfigurationsController::class, "permissions"])->middleware(['checkPerms'])->name('view_permissions');
Route::post('/permissions/role/add', [RulesController::class, "store"])->middleware(['checkPerms'])->name('view_permissions');
Route::get('/permissions/role/delete/{id}', [RulesController::class, 'destroy'])->middleware(['checkPerms'])->name('view_permissions');
Route::post('/permissions/perm/add', [PermissionsController::class, "store"])->middleware(['checkPerms'])->name('view_permissions');
Route::get('/permissions/perm/delete/{id}', [PermissionsController::class, 'destroy'])->middleware(['checkPerms'])->name('view_permissions');

//Acces
Route::get('/acces', [ConfigurationsController::class, "acces"])->middleware(['checkPerms'])->name('view_permissions');
Route::get('/acces/search/{field}', [ConfigurationsController::class, "searchacces"])->middleware(['checkPerms'])->name('view_permissions');
Route::post('/acces/edit', [UserPermissionsController::class, "update"])->middleware(['checkPerms'])->name('view_permissions');
Route::get('/acces/show/{id}', [UserPermissionsController::class, 'show'])->middleware(['checkPerms'])->name('view_permissions');

//Flux
Route::get('/flux/invoices', [FluxController::class, "InvoicesList"])->middleware(['checkPerms'])->name('view_invoices');
Route::get('/flux/invoice/show/{id}', [FluxController::class, 'ShowInvoice'])->middleware(['checkPerms'])->name('view_invoices');
Route::post('/flux/search/invoices', [FluxController::class, "searchInvoices"])->middleware(['checkPerms'])->name('view_invoices');
//-----
Route::get('/flux/desadv', [FluxController::class, "desadvList"])->middleware(['checkPerms'])->name('view_desadv');
Route::get('/flux/desadv/show/{id}', [FluxController::class, 'ShowDesadv'])->middleware(['checkPerms'])->name('view_desadv');
Route::post('/flux/search/desadv', [FluxController::class, "searchDesadv"])->middleware(['checkPerms'])->name('view_desadv');
//-----
Route::get('/flux/orders', [FluxController::class, "ordersList"])->middleware(['checkPerms'])->name('view_orders');
Route::get('/flux/order/show/{id}', [FluxController::class, 'ShowOrder'])->middleware(['checkPerms'])->name('view_orders');
Route::post('/flux/search/orders', [FluxController::class, "searchOrders"])->middleware(['checkPerms'])->name('view_orders');


//Update address flux
Route::get('/flux/desadv/edit/{gln}/{adr}', [FluxController::class, 'UpdateAdr'])->middleware(['checkPerms'])->name('view_desadv');
Route::get('/flux/invoice/edit/{gln}/{adr}', [FluxController::class, 'UpdateAdr'])->middleware(['checkPerms'])->name('view_invoices');
Route::get('/flux/order/edit/{gln}/{adr}', [FluxController::class, 'UpdateAdr'])->middleware(['checkPerms'])->name('view_orders');


//Logs
Route::get('/logs', [LogsController::class, "index"])->middleware(['checkPerms'])->name('view_logs');
Route::get('/logs/show/{id}', [LogsController::class, "show"])->middleware(['checkPerms'])->name('view_logs');
Route::get('/logs/delete/{id}', [LogsController::class, 'destroy'])->middleware(['checkPerms'])->name('view_logs');

//Download DESADV Files
Route::get('/flux/download/desadv/pdf/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadDesadv'])->middleware(['checkPerms'])->name('download_pdf_desadv');
Route::get('/flux/download/desadv/edi/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadDesadv'])->middleware(['checkPerms'])->name('download_edi_desadv');
Route::get('/flux/download/desadv/csv/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadDesadv'])->middleware(['checkPerms'])->name('download_csv_desadv');

//Download Invoices Files
Route::get('/flux/download/invoice/pdf/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadInvoice'])->middleware(['checkPerms'])->name('download_pdf_invoice');
Route::get('/flux/download/invoice/edi/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadInvoice'])->middleware(['checkPerms'])->name('download_edi_invoice');
Route::get('/flux/download/invoice/csv/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadInvoice'])->middleware(['checkPerms'])->name('download_csv_invoice');

//Download Orders Files
Route::get('/flux/download/order/pdf/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadOrder'])->middleware(['checkPerms'])->name('download_pdf_order');
Route::get('/flux/download/order/edi/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadOrder'])->middleware(['checkPerms'])->name('download_edi_order');
Route::get('/flux/download/order/csv/file/{type_file}/{id_flux}', [FluxController::class, 'DownloadOrder'])->middleware(['checkPerms'])->name('download_csv_order');

//Demat
Route::get('/demat/invoice', [FluxController::class, "dematInvoice"])->middleware(['checkPerms'])->name('view_demat_invoice');




require __DIR__.'/auth.php';
