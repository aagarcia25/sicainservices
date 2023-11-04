<?php

use App\Http\Controllers\EscanerController;
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

});
