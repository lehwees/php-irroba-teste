<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgendamentoController extends Controller
{
    /**
     * Listar agendamentos
     */
    public function index()
    {
        $medicoId = Auth::id();
        return Agendamento::where('medico_id', $medicoId)>with('paciente')->get();
    }

    /**
     * Criar um novo agendamento
     */
    public function store(Request $request)
    {
        $request->validate
        ([
            'paciente_id' => 'required|exists:pacientes,id',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $agendamento = Agendamento::create
        ([
            'medico_id' => Auth::id(),
            'paciente_id' => $request->paciente_id,
            'data' => $request->data,
            'hora' => $request->hora,
        ]);

        return response()->json($agendamento, 201);
    }

    /**
     * Mostrar um agendamento especifico
     */
    public function show(string $id)
    {
        $agendamento = Agendamento::where('id', $id)
            ->where('medico_id', Auth::id())
            ->with('paciente')
            ->first();
        
        if(!$agendamento)
        {
            return response()->json(['erro' => 'Agendamento não encontrado'], 404);
        }

        return response()->json($agendamento);
    }

    /**
     * Atualizar agendamento
     */
    public function update(Request $request, string $id)
    {
        $agendamento = Agendamento::where('id', $id)->where('medico_id', Auth::id())->first();

        if(!$agendamento)
        {
            return response()->json(['erro' => 'Agendamento não encontrado'], 404);
        }

        $request->validate
        ([
            'paciente_id' => 'exists:pacientes,id',
            'data' => 'date',
            'hora' => 'date_format:H:i',
        ]);


        $agendamento->update($request->all());

        return response()->json($agendamento);
    }

    /**
     * Deletar agendamento
     */
    public function destroy(string $id)
    {
        $agendamento = Agendamento::where('id', $id)->where('medico_id', Auth::id())->first();

        if(!$agendamento)
        {
            return response()->json(['erro'=>'Agendamento não encontrado'], 404);
        }

        $agendamento->delete();

        return response()->json(['mensagem' => 'Agendamento deletado com sucesso']);
    }

    /**
     * Listar agendamentos do médico autenticado
     */
    public function meusAgendamento()
    {
        $medicoId = Auth::id();
        $agendamentos = Agendamento::where('medico_id', $medicoId)->with('paciente')->get();

        return response()->json($agendamentos);
    }
}
