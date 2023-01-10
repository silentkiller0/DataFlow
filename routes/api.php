<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use App\Http\Controllers\API\FluxController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/flux/senddata/{syslog_id}/{status_id}/{type_flux}/{date_document}/{ref_order}/{date_order}/{ref_desadv}/{date_reception_desadv}/{ref_invoice}/{date_invoicing}/{gln_client}/{gln_fournisseur}/{gln_livraison}/{date_livraison}/{adresse_livraison}/{content}/', [FluxController::class, "store"])->middleware(['api'])->name('Send_Flux');


/*
http://127.0.0.1:8000/flux/senddata/454/1/invoice/2022-12-23/CM00002/2022-12-23/0/2022-12-24/FC00002/2022-12-25/7777777777777/5555555555555/33333333333/2022-12-24/Paris/test/


*/

//Route::apiResource('dashboard', 'dashboard.dashboard');