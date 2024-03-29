<?php

use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\EscanerController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\UtilityController;
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
    'prefix' => 'SICAIN_API_JGV',
    'middleware' => ['api'],
], function () {
    Route::post('login', [LoginController::class, 'login'])->middleware('throttle:5,10');
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('logoutuser', [LoginController::class, 'logoutuser']);
    Route::post('ChangePassword', [LoginController::class, 'ChangePassword']);
    Route::post('Escaner', [EscanerController::class, 'Escaner']);
    Route::post('incidencia', [IncidenciaController::class, 'incidencia']);
    Route::post('incidenciaList', [IncidenciaController::class, 'incidenciaList']);
    Route::post('totalincidencias', [IncidenciaController::class, 'totalincidencias']);
    Route::post('Incidenciasporfecha', [IncidenciaController::class, 'Incidenciasporfecha']);
    Route::post('usuarios', [UsuariosController::class, 'usuarios']);
    Route::post('selectores', [UtilityController::class, 'selectores']);
});
