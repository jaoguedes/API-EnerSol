<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlacaController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\GeradorController;
use App\Http\Controllers\AnalisePlacaController;
use App\Http\Controllers\CarrinhoController;


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

// Route::apiResource('usuarios', UserController::class);

// Rota específica para compras no carrinho
Route::post('carrinho/comprar', [CarrinhoController::class, 'comprar']);

Route::apiResource('usuarios', UserController::class);
Route::post('usuarios', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('placas', [PlacaController::class, 'index']);
    Route::get('placas/{id}', [PlacaController::class, 'show']);
    Route::post('placas', [PlacaController::class, 'store']);
    Route::put('placas/{id}', [PlacaController::class, 'update']);
    Route::delete('placas/{id}', [PlacaController::class, 'destroy']);

    Route::apiResource('kits', KitController::class);
    Route::apiResource('geradores', GeradorController::class);
    Route::apiResource('analises', AnalisePlacaController::class);
});