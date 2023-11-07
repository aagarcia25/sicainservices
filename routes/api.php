<?php

use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\EscanerController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\LoginController;
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

Route::group([
    'prefix' => 'SICAIN',
], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('Escaner', [EscanerController::class, 'Escaner']);
    Route::post('Bitacora', [BitacoraController::class, 'Bitacora']);
    Route::post('Bitacorafull', [BitacoraController::class, 'Bitacorafull']);
    Route::post('incidencia', [IncidenciaController::class, 'incidencia']);
    Route::post('incidenciaList', [IncidenciaController::class, 'incidenciaList']);

});
