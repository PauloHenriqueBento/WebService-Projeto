<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\FuncionarioController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::post('logout', [PassportAuthController::class, 'logout'])->middleware('auth:api');
Route::get('user', [PassportAuthController::class, 'userInfo'])->middleware('auth:api');
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('empresas', EmpresaController::class)->middleware('auth:api');
Route::apiResource('departamentos', \App\Http\Controllers\Api\DepartamentoController::class)->middleware('auth:api');
Route::apiResource('funcionarios', FuncionarioController::class)->middleware('auth:api');
