<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\EmpresaController;
use App\Http\Controllers\Api\v1\FuncionarioController;
use App\Http\Controllers\Api\v1\DepartamentoController;
use App\Http\Controllers\Api\PassportAuthController;


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
Route::middleware("localization")->group(function(){
    Route::post('register', [PassportAuthController::class, 'register']);
    Route::post('login', [PassportAuthController::class, 'login']);
    Route::post('logout', [PassportAuthController::class, 'logout'])->middleware('auth:api');
    Route::get('user', [PassportAuthController::class, 'userInfo'])->middleware('auth:api');

    Route:: apiResource('empresas', EmpresaController::class)->middleware('auth:api');
    Route::apiResource('funcionarios', FuncionarioController::class)->middleware('auth:api');
    //Route:: apiResource('departamentos', \App\Http\Controllers\Api\v1\DepartamentoController::class)->middleware('auth:api');
    Route:: apiResource('departamentos', DepartamentoController::class)->middleware('auth:api');
});

