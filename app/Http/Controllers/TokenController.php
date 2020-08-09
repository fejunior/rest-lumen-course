<?php

namespace  App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerarToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $usuario = User::where('email', $request->email)->first();

        if (is_null($usuario) || !Hash::check($request->password, $usuario->password)) {
            return response()->json('Ususario ou senha não encontrados', 401);
        }

        $token =  JWT::encode([
            'email' => $request->email,

        ], env('JWT_KEY'));

        return [
            'access_token' => $token
        ];
    }
}
