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

Route::get('usuarios', [UserController::class, 'index']);
Route::post('/usuarios/login', [UserController::class, 'login']);
Route::post('usuarios', [UserController::class, 'store']);
Route::put('kits/{id}', [UserController::class, 'update']);
Route::delete('kits/{id}', [UserController::class, 'destroy']);


Route::get('kits', [KitController::class, 'index']);
Route::get('kits/{id}', [KitController::class, 'show']);
Route::post('kits', [KitController::class, 'store']);
Route::put('kits/{id}', [KitController::class, 'update']);
Route::delete('kits/{id}', [KitController::class, 'destroy']);

Route::get('placas', [PlacaController::class, 'index']);
Route::get('placas/{id}', [PlacaController::class, 'show']);
Route::post('placas', [PlacaController::class, 'store']);
Route::put('placas/{id}', [PlacaController::class, 'update']);
Route::delete('placas/{id}', [PlacaController::class, 'destroy']);

Route::get('geradores', [GeradorController::class, 'index']);
Route::get('geradores/{id}', [GeradorController::class, 'show']);
Route::post('geradores', [GeradorController::class, 'store']);
Route::put('geradores/{id}', [GeradorController::class, 'update']);
Route::delete('geradores/{id}', [GeradorController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('analises', AnalisePlacaController::class);
});