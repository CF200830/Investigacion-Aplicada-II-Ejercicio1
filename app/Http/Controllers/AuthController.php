<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use symfony\Component\HttpFoundation\Response;
use App\Models\User;


class AuthController extends Controller
{
    public function registro(Request $request)
    {
       $request -> validate([ //validacion de datos
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
       ]);

       $user = new User();  //registro del usuario
       $user -> name = $request->name;
       $user -> email = $request->email;
       $user -> password = Hash::make($request->password);
       $user-> save();

       return response()->json([   //respuesta al cliente
        'message' => 'Usuario registrado con éxito'], 200);
    }

    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }
    
        $token = $user->createToken('Token')->plainTextToken;
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Usuario autenticado con éxito'
        ], 200);
    }

    public function logout(Request $request){

        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Usuario deslogeado con éxito'
        ], 200);
    }
}
