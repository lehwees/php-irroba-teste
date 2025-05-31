<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendamentoController;

//Rota verificar o usuário autenticado
Route::middleware('auth:api')->get('/user', function (Request $request) 
{
    return $request->user();
});

//Rotas login e cadastro médicos
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Rotas de autenticação com Passport
Route::middleware('auth:api')->group(function()
{

    //CRUD Pacientes
    Route::apiResource('pacientes', PacienteController::class);

    //CRUD Agendamentos
    Route::apiResource('agendamentos', AgendamentoController::class);

    //Rota de listamento da agenda do médico logado
    Route::get('/meus-agendamentos', [AgendamentoController::class, 'meusAgendamentos']);

});

