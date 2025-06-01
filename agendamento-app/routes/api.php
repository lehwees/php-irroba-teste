<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;


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

    //Rotas de autenticação com Passport     
    Route::middleware('auth:api')->group(function() {

    //CRUD Pacientes
    Route::apiResource('pacientes', PacienteController::class);
    Route::get('/pacientes/{id}/agendamentos', [PacienteController::class, 'agendamentos']);
    Route::get('medicos/{medico}/pacientes', [PacienteController::class, 'pacientesByMedico']);
    Route::post('medicos/{medico}/pacientes', [PacienteController::class, 'storeByMedico']);
    Route::put('/medicos/{medico}/pacientes/{paciente}', [PacienteController::class, 'updateFromMedico']);
    Route::delete('medicos/{medico}/pacientes/{paciente}', [PacienteController::class, 'destroyByMedico']);
    Route::get('/pacientes', [PacienteController::class, 'index']);

    //CRUD Agendamentos
    Route::apiResource('agendamentos', AgendamentoController::class);
    Route::get('/agendamentos', [AgendamentoController::class, 'index']);
    Route::post('/agendamentos', [AgendamentoController::class, 'store']);
    Route::put('medicos/{medico}/agendamentos/{agendamento}', [AgendamentoController::class, 'updateByMedico']);
    Route::delete('medicos/{medico}/agendamentos/{agendamento}', [AgendamentoController::class, 'destroyByMedico']);

    //Rota de listamento da agenda do médico logado
    Route::get('/meus-agendamentos', [AgendamentoController::class, 'meusAgendamentos']);

    //Rota médicos
    Route::get('/medicos', [MedicoController::class, 'index']);
    Route::delete('/medicos/{id}', [MedicoController::class, 'destroy']);
    Route::get('/medicos/{id}/agendamentos', [MedicoController::class, 'agendamentos']);
    Route::post('medicos/{medico}/agendamentos', [AgendamentoController::class, 'storeByMedico']);
});