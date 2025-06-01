<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Listar todos os pacientes logados
     */
    public function index()
    {
        $medico = auth::user();
        $Paciente = Paciente::where('medico_id', $medicoId)->get();

        return response()->json($pacientes);
    }

    /**
     * Cadastrar novo paciente
     */
    public function store(Request $request)
    {
        $medicoId = Auth::id();
        
        $validateDAta = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:pacientes,cpf',
            'telefone' => 'nullable|string|max:255',
            'nascimento' => 'nullable|date',
        ]);

        $paciente = Paciente::create
        ([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefon,
            'nascimento' => $request->nascimento,
            'medico_id' => Auth::id()
        ]);

        return response()->json($paciente, 201);
    }

    /**
     * Mostrar algum paciente específico
     */
    public function show(string $id)
    {
        $paciente = Paciente::where('id', $id)->where('medico_id', Auth::id())->first();

        if(!$paciente)
        {
            return response()->json(['erro' => 'Paciente não encontrado ou não autorizado'], 404);
        }

        return response()->json($paciente);
    }

    /**
     * Atualizar um paciente
     */
    public function update(Request $request, $id)
    {
        $paciente = Paciente::where('id', $id)->where('medico_id', Auth::id())->first();

        if(!$paciente)
        {
            return response()->json(['erro' => 'Paciente não encontrado ou não autorizado'], 404);
        }

        $paciente->update($request->only(['nome', 'cpf', 'telefone', 'nascimento']));

        return response()->json($paciente);
    }

    /**
     *  Deletar paciente
     */
    public function destroy(string $id)
    {
        $paciente = Paciente::where('id', $id)->where('medico_id', Auth::id())->first();

        if(!$paciente)
        {
            return response()->json(['erro' => 'Paciente não encontrado ou não autorizado'], 404);
        }

        $paciente->delete();

        return response()->json(['mensagem' => 'Paciente deletado com sucesso']);
    }

    public function pacientesByMedico($medicoId)
    {
        // Busca pacientes pelo medico_id
        $pacientes = Paciente::where('medico_id', $medicoId)->get();

        return response()->json($pacientes);
    }

    public function storeByMedico(Request $request, $medicoId)
     {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:pacientes,cpf',
            'telefone' => 'nullable|string|max:255',
            'nascimento' => 'nullable|date',
        ]);

        $medico = Medico::findOrFail($medicoId);

        $paciente = new Paciente($validatedData);
        $paciente->medico()->associate($medico);
        $paciente->save();

        return response()->json([
            'message' => 'Paciente criado com sucesso',
            'paciente' => $paciente
        ], 201);
    }

    public function updateFromMedico(Request $request, $medicoId, $pacienteId)
    {
        $medico = auth()->user();
        if ($medico->id != $medicoId) {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }

        $paciente = $medico->pacientes()->where('id', $pacienteId)->first();

        if (!$paciente) {
            return response()->json(['message' => 'Paciente não encontrado.'], 404);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:pacientes,cpf',
            'telefone' => 'nullable|string|max:255',
            'nascimento' => 'nullable|date',
        ]);

        $paciente->update($request->only(['nome', 'email', 'telefone']));

        return response()->json($paciente);
    }

    public function destroyByMedico($medicoId, $pacienteId)
    {
        $medico = Medico::findOrFail($medicoId);
        $paciente = $medico->pacientes()->where('pacientes.id', $pacienteId)->first();

        if (!$paciente) {
            return response()->json(['message' => 'Paciente não encontrado para este médico'], 404);
        }

        $paciente->delete();

        return response()->json(['message' => 'Paciente deletado com sucesso']);
    }
}
