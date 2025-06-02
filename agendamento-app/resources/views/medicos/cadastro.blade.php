@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastro de Médico</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicos.store') }}" method="POST">
        @csrf

        <div>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>

        <div>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Cadastrar</button>
    </form>
</div>
@endsection