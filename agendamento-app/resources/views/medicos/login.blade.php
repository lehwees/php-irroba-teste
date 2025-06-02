@extends('layouts.app')

@section('title', 'Login Médico')

@section('content')
  <h1>Login Médico</h1>

  <form method="POST" action="{{ route('medicos.login.submit') }}">
    @csrf
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required />

    <label for="password">Senha:</label>
    <input type="password" id="password" name="password" required />

    <button type="submit">Entrar</button>
  </form>
@endsection