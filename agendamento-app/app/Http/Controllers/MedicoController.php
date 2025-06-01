<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        return response()->json(Medico::all(['id', 'nome', 'email']));
    }

    public function destroy($id)
    {
        $medico = Medico::find($id);

        if(!$medico)
        {
            return response()->json(['error' => 'Medico não encontrado'], 404);
        }

        $user->delete();
        return response()->json(['messagem' => 'Médico deletado com sucesso']);
    }

    public function agendamentos($id)
    {
        $medico = Medico::with('agendamentos.paciente')->findOrFail($id);
        return response()->json($medico->agendamentos);
    }
}
