<?php

use App\Http\Controllers\Api\AlunoController;
use App\Http\Controllers\Api\AutorizadoController;
use App\Http\Controllers\Api\CardapioController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ContagemNeController;
use App\Http\Controllers\Api\ContagenController;
use App\Http\Controllers\Api\ControleDeProducaoEConsumoController;
use App\Http\Controllers\Api\CronogramaController;
use App\Http\Controllers\Api\NecessidadeController;
use App\Http\Controllers\Api\TurmaController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Models\ContagemNe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function(){ 
    Route::get('/contagens/dashboard',[DashboardController::class,'contagemDashboard']);
    Route::apiResource('categorias', CategoriaController::class)->only(['show','index']);
    Route::apiResource('turmas', TurmaController::class)->only(['show','index']);
    Route::apiResource('contagens', ContagenController::class);
    Route::apiResource('necessidades', NecessidadeController::class)->only(['index','show']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::apiResource('contagem-nes', ContagemNeController::class);
    Route::apiResource('cronogramas', CronogramaController::class)->only(['show','index']);
    Route::apiResource('users',UserController::class)->except(['store','destroy']);
    Route::apiResource('alunos', AlunoController::class)->only(['index','show']);
    Route::put('/reset-senha',[UserController::class,'resetPassword']);
    Route::apiResource('cardapios',CardapioController::class);
    Route::apiResource('autorizados', AutorizadoController::class)->except(['update']);
    Route::apiResource('chats', ChatController::class);
});

Route::middleware(['auth:sanctum','NutriRole'])->group(function(){
    Route::apiResource('categorias', CategoriaController::class)->except(['show','index']);
    Route::apiResource('turmas', TurmaController::class)->except(['show','index']);
    Route::apiResource('controle_de_producao', ControleDeProducaoEConsumoController::class);
    Route::apiResource('alunos', AlunoController::class)->except(['index','show']);
    Route::apiResource('necessidades', NecessidadeController::class)->except(['index','show']);
    Route::post('/alunos/{aluno}/necessidades',[AlunoController::class,'relationNecessidades']);
    Route::apiResource('cronogramas', CronogramaController::class)->except(['show','index']);
    Route::post('/alunos/{necessidade}/dias',[NecessidadeController::class,'relationCronograma']);
    Route::delete('/alunos/{necessidade}/dias',[NecessidadeController::class,'deleteCronograma']);
    Route::delete('/necessidade/{necessidade}/alunos',[NecessidadeController::class,'disableAluno']);
    Route::post('/upload',[FileController::class,'uploadImage']);
    Route::post('/upload/pdf',[FileController::class,'uploadPdf']);
    Route::apiResource('users',UserController::class)->only(['store','destroy']);
});

Route::middleware(['auth:sanctum','DiretorRole'])->group(function(){
    Route::apiResource('autorizados', AutorizadoController::class)->only(['update']);
});