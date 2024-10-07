<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid input'], 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!password_verify($password, $user->password)) {
            return response()->json(['error' => 'Email or password incorrect'], 401);
        }

        //$token = $user->createToken('auth_token', ['*'], now()->addWeek())->plainTextToken; //Configurar quando lançar
        $token = $user->createToken('auth_token', ['*'], now()->AddMinute())->plainTextToken;

        return response()->json([
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'is_admin' => $user->is_admin,
            ],
            'access_token' => $token,
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid input'], 400);
        }

        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $name = $request->input('name');

        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['error'=> 'User already exist'],404);
        }

        User::create([
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'is_admin' => false, //Melhor setar como true somente no banco de dados
        ]);

        return response()->json(['message' => 'User created'], 201);
    }
}
