<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function register(Request $request)
{
    $validator->validator::make($request->all(),[
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
        'password' => Hash::make($request>password),
    ]);

    $token - $medico->createToken('token-medico')->accessToken;
    return response()->json([
        'token' => $token,
        'medico' => $medico ], 201);
}

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::guard('web')->attempt($credentials))
        {
            $medico = Auth::guard('web')->user();
            return response()->json(
                [   'token' => $token,
                    'medico' => $medico
                ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
        
}
