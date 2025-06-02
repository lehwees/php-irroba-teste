<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Sistema Médico')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"></head>
<body>
  <header>
    <nav>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('medicos.login') }}">Login Médico</a>
    <a href="{{ route('medicos.cadastro') }}">Cadastro Médico</a> |
    <a href="{{ route('pacientes.cadastro') }}">Cadastro Paciente</a> |
    <a href="{{ route('agendamento.form') }}">Agendamento</a> |

    @isset($paciente)
        <a href="{{ route('paciente.editar', $paciente->id) }}">Editar Paciente</a>
    @endisset

    @isset($agendamento)
        <a href="{{ route('agendamento.editar', $agendamento->id) }}">Editar Agendamento</a>
    @endisset
    </nav>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>