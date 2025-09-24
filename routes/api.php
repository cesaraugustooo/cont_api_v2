<?php

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ContagenController;
use App\Http\Controllers\Api\TurmaController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function(){ 
    Route::apiResource('categorias', CategoriaController::class)->only(['show','index']);
    Route::apiResource('turmas', TurmaController::class)->only(['show','index']);
    Route::apiResource('contagens', ContagenController::class);
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::middleware(['auth:sanctum','NutriRole'])->group(function(){
    Route::apiResource('categorias', CategoriaController::class)->except(['show','index']);
    Route::apiResource('turmas', TurmaController::class)->except(['show','index']);
});

