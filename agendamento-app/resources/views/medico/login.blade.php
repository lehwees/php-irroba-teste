@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Login do Médico</h1>
        <form method="POST" action="{{ route('medicos.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password">Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
@endsection