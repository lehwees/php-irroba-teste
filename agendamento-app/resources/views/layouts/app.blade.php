<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento Médico</title>

    {{-- Estilo personalizado --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="brand" href="{{ url('/') }}">Agendamento</a>
            <ul class="nav-links">
                <li><a href="{{ route('medicos.login') }}">Login Médico</a></li>
                <li><a href="{{ route('medicos.cadastro') }}">Cadastro Médico</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>