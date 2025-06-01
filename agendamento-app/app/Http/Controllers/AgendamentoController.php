<?php


namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AgendamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Listar agendamentos
     */
    public function index()
    {
        return Agendamento::with('paciente')
                          ->where('medico_id', Auth::id())
                          ->get();
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

        $paciente = Paciente::where('id', $request->paciente_id)
                            ->where('medico_id', Auth::id())
                            ->first();

        if(!$paciente)
        {
            return response()->json(['erro'=>'Paciente não vinculado ao médico'], 403);
        }

        $agendamento = Agendamento::create
        ([
            'medico_id' => Auth::id(),
            'paciente_id' => $request->paciente_id,
            'data' => $request->data,
            'hora' => $request->hora,
        ]);

        return response()->json([
            'mensagem' => 'Agendamento criado com sucesso',
            'agendamento' => $agendamento
        ], 201);    
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
        $agendamento = Agendamento::where('id', $id)
                                  ->where('medico_id', Auth::id())
                                  ->first();

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

        if($request->has('paciente_id'))
        {
            $paciente = Paciente::where('id', $request->paciente_id)
                                ->where('medico_id', Auth::id())
                                ->first();

            if(!$paciente)
            {
                return response()->json(['erro' => 'Paciente não vinculado ao médico'], 403);
            }
        }


        $agendamento->update($request->only(['paciente_id', 'data', 'hora']));

        return response()->json($agendamento);
    }

    /**
     * Deletar agendamento
     */
    public function destroy(string $id)
    {
        $agendamento = Agendamento::where('id', $id)
                                  ->where('medico_id', Auth::id())
                                  ->first();

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
    public function meusAgendamentos()
    {
        return Agendamento::with('paciente')
                          ->where('medico_id', Auth::id())
                          ->orderBy('data')
                          ->orderBy('hora')
                          ->get();
    }

    public function storeByMedico(Request $request, $medicoId)
    {
        $validated = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'data_hora' => 'required|date',
            'status' => 'required|string',
        ]);

        $paciente = Paciente::where('id', $validated['paciente_id'])
                            ->where('medico_id', $medicoId)
                            ->first();

        if(!$paciente)
        {
            return response()->json(['erro' => 'Paciente não vinculado ao médico'], 403);
        }
        
        $data = date('Y-m-d', strtotime($validated['data_hora']));
        $hora = date('H:i', strtotime($validated['data_hora']));

            
        $agendamento = new Agendamento
        ([
            'paciente_id' => $request->paciente_id,
            'data' => $data,
            'hora' => $hora,
            'status' => $request->status,
        ]);

        $agendamento->medico_id = $medicoId;
        $agendamento->save();

        return response()->json($agendamento, 201);
    }

    public function alterarStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $agendamento = Agendamento::where('id', $id)
                                ->where('medico_id', Auth::id())
                                ->first();

        if (!$agendamento) {
            return response()->json(['erro' => 'Agendamento não encontrado'], 404);
        }

        $agendamento->status = $request->status;
        $agendamento->save();

        return response()->json(['mensagem' => 'Status atualizado com sucesso']);
    }

    public function updateByMedico(Request $request, $medicoId, $agendamentoId)
    {
        // Verifica se o agendamento pertence ao médico
        $agendamento = Agendamento::where('id', $agendamentoId)
            ->where('medico_id', $medicoId)
            ->first();

        if (!$agendamento) {
            return response()->json(['error' => 'Agendamento não encontrado para este médico'], 404);
        }

        // Validação dos dados (ajuste conforme campos que podem ser alterados)
        $validated = $request->validate([
            'data' => 'required|date',
            'hora' => 'required',
            'paciente_id' => 'required|exists:pacientes,id',
            // outros campos que quiser validar...
        ]);

        // Atualiza o agendamento
        $agendamento->update($validated);

        return response()->json($agendamento);
    }

    public function destroyByMedico($medicoId, $agendamentoId)
    {
        $agendamento = Agendamento::where('id', $agendamentoId)
            ->where('medico_id', $medicoId)
            ->first();

        if (!$agendamento) {
            return response()->json(['message' => 'Agendamento não encontrado para esse médico'], 404);
        }

        $agendamento->delete();

        return response()->json(['message' => 'Agendamento deletado com sucesso']);
    }
}
