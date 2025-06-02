<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\LoginController;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Médico: Login e Cadastro
Route::get('/login-medico', [MedicoController::class, 'LoginForm'])->name('medicos.login');
Route::post('/login-medico', [MedicoController::class, 'login'])->name('medicos.login.submit');

Route::get('/login', [LoginController::class, 'LoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/medico/dashboard', [MedicoController::class, 'dashboard'])->name('medico.dashboard');

Route::resource('medicos', MedicoController::class);
Route::get('/medicos/cadastro', [MedicoController::class, 'create'])->name('medicos.cadastro');
Route::get('/medicos/cadastro', [MedicoController::class, 'create'])->name('medicos.create');
Route::post('/medicos', [MedicoController::class, 'store'])->name('medicos.store');

// Paciente: Cadastro e gerenciamento
Route::get('/pacientes/cadastro', [PacienteController::class, 'create'])->name('pacientes.cadastro'); // mostrar formulário
Route::post('/pacientes/cadastro', [PacienteController::class, 'store'])->name('pacientes.store'); // salvar paciente

// Editar paciente
Route::get('/pacientes/cadastro', [PacienteController::class, 'create'])->name('pacientes.create');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');

// Agendamento
Route::get('/agendamento', [AgendamentoController::class, 'showAgendamentoForm'])->name('agendamento.form');
Route::post('/agendamento', [AgendamentoController::class, 'agendar'])->name('agendamento.agendar');

Route::get('/editar-agendamento/{id}', [AgendamentoController::class, 'editar'])->name('agendamento.editar');
Route::post('/editar-agendamento/{id}', [AgendamentoController::class, 'atualizar'])->name('agendamento.atualizar');