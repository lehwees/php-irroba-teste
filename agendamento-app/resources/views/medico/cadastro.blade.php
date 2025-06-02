@extends('layouts.app')

@section('title', 'Cadastro Médico')

@section('content')
  <h1>Cadastro Médico</h1>

  <form method="POST" action="{{ route('medicos.cadastro') }}">
    @csrf

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required />

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required />

    <label for="crm">CRM:</label>
    <input type="text" id="crm" name="crm" required />

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required />

    <button type="submit">Cadastrar</button>
  </form>
@endsection