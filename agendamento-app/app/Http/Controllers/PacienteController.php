<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    /**
     * Listar todos os pacientes logados
     */
    public function index()
    {
        return Paciente::all();
    }

    /**
     * Cadastrar novo paciente
     */
    public function store(Request $request)
    {
        $medico = auth()->user();

        if(!$medico)
            {
                return response()->json(['error' => 'Médico não encontrado'], 403);
            }

        $request->validate(
            [
                'nome' => 'required|string|max:255',
                'cpf' => 'required|string|unique:pacientes,cpf',
                'telefone' => 'nullable|string|max:255',
                'nascimento' => 'nullable|date',
            ]);

            $data = $request->all();
            $data['medico_id'] = $medico->id;

            $paciente = Paciente::create($request->all());

            return response()->json($paciente, 201);
    }

    /**
     * Mostrar algum paciente específico
     */
    public function show(string $id)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
        {
            return response()->json(['erro' => 'Paciente não encontrado'], 404);
        }

        return response()->json($paciente);
    }

    /**
     * Atualizar um paciente
     */
    public function update(Request $request, string $id)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
        {
            return response()->json(['erro' => 'Paciente não encontrado'], 404);
        }

        $paciente->update($request->all());

        return response()->json($paciente);
    }

    /**
     *  Deletar paciente
     */
    public function destroy(string $id)
    {
        $paciente = Paciente::find($id);

        if(!$paciente)
        {
            return response()->json(['erro' => 'Paciente não encontrado'], 404);
        }

        $paciente->delete();

        return response()->json(['mensagem' => 'Paciente deletado com sucesso']);
    }
}
