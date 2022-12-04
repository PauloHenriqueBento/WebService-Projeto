<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\EmpresaController;
use App\Http\Controllers\Api\v1\FuncionarioController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route:: apiResource('empresas', EmpresaController::class);
Route::apiResource('funcionarios', FuncionarioController::class);
Route:: apiResource('departamentos', \App\Http\Controllers\Api\v1\DepartamentoController::class);
