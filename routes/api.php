<?php

use App\Http\Controllers\Api\ProvinciaController;
use App\Http\Controllers\Api\CodigoPostalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Provincias
Route::get('/provincias/{pais_id}', [ProvinciaController::class, 'porPais']);

//Codigo Postal
Route::get('/cod_postal/{pais_id}/{provincia_id}', [CodigoPostalController::class, 'porPaisProvincia']);
