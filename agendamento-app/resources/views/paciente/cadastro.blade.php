@extends('layouts.app')

@section('title', 'Cadastro Paciente')

@section('content')
  <h1>Cadastro Paciente</h1>

  <form method="POST" action="{{ route('pacientes.cadastro') }}">
    @csrf

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required />

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required />

    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" required />

    <button type="submit">Cadastrar</button>
  </form>
@endsection