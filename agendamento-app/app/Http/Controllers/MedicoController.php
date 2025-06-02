<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $medico->delete();
        return response()->json(['messagem' => 'Médico deletado com sucesso']);
    }

    public function agendamentos($id)
    {
        $medico = Medico::with('agendamentos.paciente')->findOrFail($id);
        return response()->json($medico->agendamentos);
    }

    /**
     * Form para as telas 
    */

    public function LoginForm()
    {
        return view('medico.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('medico')->attempt($credentials)) {
            // Login OK
            return redirect()->route('medico.dashboard'); 
        }

        // Falha no login
        return redirect()->back()->withErrors(['email' => 'Credenciais inválidas']);
    }

    public function dashboard()
    {
        if (!Auth::guard('medico')->check()) {
            return redirect()->route('login-medico')->with('error', 'Você precisa estar logado.');
        }

        $medico = Auth::guard('medico')->user();
        $pacientes = $medico->pacientes ?? [];
        $agendamentos = $medico->agendamentos ?? [];

        return view('medico.dashboard', compact('medico', 'pacientes', 'agendamentos'));
    }

    public function formCadastro()
    {
        return view('medico.cadastro');
    }
    /**
    * Cadastro tela medico 
    */

    public function create()
    {
        return view('medicos.cadastro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:medicos,email',
            'password' => 'required|string|min:6',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        Medico::create($data);

        return redirect()->route('medicos.create')->with('success', 'Médico cadastrado com sucesso!');
    }

    public function show($medico)
    {
        // Código para exibir médico pelo ID ou slug
        $medico = Medico::findOrFail($medico);
        return view('medicos.show', compact('medico'));
    }
}
