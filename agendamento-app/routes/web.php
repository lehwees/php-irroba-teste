<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendamentoController;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Médico: Login e Cadastro
Route::get('login-medico', [MedicoController::class, 'showLoginForm'])->name('login-medico');
Route::post('login-medico', [MedicoController::class, 'login'])->name('login-medico.submit');

Route::get('/cadastro-medico', [MedicoController::class, 'showCadastroForm'])->name('medicos.cadastro');
Route::post('/cadastro-medico', [MedicoController::class, 'cadastrar']);

// Paciente: Cadastro
Route::get('/cadastro-paciente', [PacienteController::class, 'showCadastroForm'])->name('paciente.cadastro');
Route::post('/cadastro-paciente', [PacienteController::class, 'cadastrar']);

// Agendamento
Route::get('/agendamento', [AgendamentoController::class, 'showAgendamentoForm'])->name('agendamento.form');
Route::post('/agendamento', [AgendamentoController::class, 'agendar']);

// Tela para o médico alterar paciente e agendamento
Route::get('/editar-paciente/{id}', [PacienteController::class, 'editar'])->name('paciente.editar');
Route::post('/editar-paciente/{id}', [PacienteController::class, 'atualizar']);

Route::get('/editar-agendamento/{id}', [AgendamentoController::class, 'editar'])->name('agendamento.editar');
Route::post('/editar-agendamento/{id}', [AgendamentoController::class, 'atualizar']);