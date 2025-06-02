@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Bem-vindo, Dr. {{ $medico->name }}</h1>

    <div class="mb-10">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Seus Pacientes</h2>
        @if(count($pacientes) > 0)
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($pacientes as $paciente)
                    <li class="bg-white shadow p-4 rounded-xl border border-gray-200">
                        <span class="font-medium text-gray-700">{{ $paciente->nome }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Nenhum paciente cadastrado ainda.</p>
        @endif
    </div>

    <div>
        <h2 class="text-2xl font-semibold text-green-700 mb-4">Seus Agendamentos</h2>
        @if(count($agendamentos) > 0)
            <ul class="space-y-3">
                @foreach($agendamentos as $agendamento)
                    <li class="bg-white shadow p-4 rounded-xl border border-gray-200">
                        <span class="text-gray-700 font-medium">{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y H:i') }}</span> – 
                        <span class="text-gray-600">{{ $agendamento->paciente->nome }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Nenhum agendamento realizado ainda.</p>
        @endif
    </div>
</div>
@endsection