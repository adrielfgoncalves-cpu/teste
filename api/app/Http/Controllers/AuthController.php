<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Levels;
use App\Http\Requests\UserRegisterRequest;




class AuthController extends Controller
{
    // Registro de novo usuário
    public function register(UserRegisterRequest $request)
    {
        $fields = $request->validated();

        $levelUser = '';

        // se veio um nível:
        if (isset($fields['levels'])) {
            $levelUser = $fields['levels'];
        //se nao foi informado o level do user, seta User
        } else {
            $levelUser = Levels::where('name', 'User')->first()->id;
        }

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $user->levels()->attach($levelUser);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // Login e geração de token
    public function login(UserLoginRequest $request)
    {
        $fields = $request->validated();

        $user = User::where('email', $fields['email'])->first();

        if (! $user || ! Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('api_token', $user->getLevelNames())->plainTextToken;

        return response()->json([
            'user' => $user->name,
            'email' => $user->email,
            'token' => $token
        ], 200);
    }

    // Logout (revoga tokens)
    public function logout(Request $request)
    {
        //dd($request->user());
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }
}
