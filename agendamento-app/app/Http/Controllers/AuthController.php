<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function register(Request $request)
{
    $validator = Validator::make($request->all(),
    [
        'nome' => 'required',
        'email' => 'required|email|unique:medicos',
        'password' => 'required|min:6',

    ]);

    if ($validator->fails()) {
        return response()->json(['erro' => $validator->errors()], 422);
    }

    $medico = Medico::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json($medico, 201);
}

public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $medico = Medico::where('email', $request->email)->first();

        if (!$medico || !Hash::check($request->password, $medico->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $medico->createToken('token-medico')->accessToken;

        return response()->json([
            'token' => $token,
            'medico' => $medico
        ]);
    }   
}
