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
        $request>validate(
            [
                'nome' => 'required|string',
                'cpf' => 'required|string|unique:pacientes',
                'nascimento' => 'required|date',
            ]);

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
