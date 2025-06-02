@extends('layouts.app')

@section('title', 'Agendamento')

@section('content')
  <h1>Agendar Consulta</h1>

  <form method="POST" action="{{ route('agendamento.salvar') }}">
    @csrf

    <label for="paciente">Paciente:</label>
    <input type="text" id="paciente" name="paciente" required />

    <label for="data">Data:</label>
    <input type="date" id="data" name="data" required />

    <label for="hora">Hora:</label>
    <input type="time" id="hora" name="hora" required />

    <button type="submit">Agendar</button>
  </form>
@endsection