<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PacienteController;


// Rota simples para teste sem autenticação
Route::get('/teste', function () {
    return response()->json(['msg' => 'rota teste funcionando']);
});

//Rota verificar o usuário autenticado   
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Rotas login e cadastro médicos
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/medicos', [App\Http\Controllers\AuthController::class, 'register']);

//Rotas de autenticação com Passport     
Route::middleware('auth:api')->group(function() {
    //CRUD Pacientes
    Route::middleware('auth:api')->group(function () 
    {
        Route::apiResource('pacientes', PacienteController::class);
    });

    //CRUD Agendamentos
    Route::apiResource('agendamentos', AgendamentoController::class);

    //Rota de listamento da agenda do médico logado
    Route::get('/meus-agendamentos', [AgendamentoController::class, 'meusAgendamentos']);
});