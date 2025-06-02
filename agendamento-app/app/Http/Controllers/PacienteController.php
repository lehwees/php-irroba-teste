<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PacienteController extends Controller
{
    /**
     * Listar todos os pacientes logados
     */
    public function index()
    {
        $medicoId = Auth::id();
        $pacientes = Paciente::where('medico_id', $medicoId)->get();

        return response()->json($pacientes);
    }

    /**
     * Cadastrar novo paciente
     */
    public function store(Request $request)
    { 
        $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|unique:pacientes,cpf',
        'telefone' => 'nullable|string|max:255',
        'nascimento' => 'nullable|date',
    ]);

    $data = $request->all();
    $data['medico_id'] = auth()->id();

    Paciente::create($data);

    return redirect()->route('pacientes.create')->with('success', 'Paciente cadastrado com sucesso!');
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

    public function cadastrar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:pacientes,cpf',
            'telefone' => 'required|string|max:20',
        ]);

        $paciente = new Paciente();
        $paciente->nome = $request->nome;
        $paciente->cpf = $request->cpf;
        $paciente->telefone = $request->telefone;
        $paciente->medico_id = Auth::id(); // importante vincular o paciente ao médico logado
        $paciente->save();

        return redirect()->route('cadastro-paciente')->with('success', 'Paciente cadastrado com sucesso!');
    }

    public function create()
    {
        return view('pacientes.cadastro');
    }

    public function showCadastroForm()
    {
        return view('paciente.cadastro');
    }

    public function salvar(Request $request)
    {
        // validação e salvamento
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
        ]);

        // Exemplo simples para salvar:
        Paciente::create($request->all());

        return redirect()->route('pacientes.cadastro')->with('success', 'Paciente cadastrado com sucesso!');
    }

}
