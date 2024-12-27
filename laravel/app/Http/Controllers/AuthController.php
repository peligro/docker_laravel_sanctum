<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function registro(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'nombre' => 'required|string|max:255',
                'correo' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'correo.required'=>'El campo correo está vacío',
                'correo.email'=>'El correo ingresado no es válido',
                'correo.unique'=>'El correo ingresado ya está siendo usado',
                'password.required'=>'El campo Contraseña está vacío',
                'password.min'=>'El campo Contraseña debe tener al menos 6 caracteres',
                'password_confirmation.required'=>'El campo Repetir Contraseña está vacío',
                'password_confirmation.min'=>'El campo Repetir Contraseña debe tener al menos 6 caracteres',
                'password.confirmed'=>'Las Contraseñas ingresadas no coinciden',
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'estado' => 'ok',
            'mensaje' => 'Se crea registro exitosamente'
        ], 201);
    }

    // Inicio de sesión
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'correo' => 'required|email:rfc,dns',
                'password' => 'required|string|min:6',
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'correo.required'=>'El campo correo está vacío',
                'correo.email'=>'El correo ingresado no es válido',
                'password.required'=>'El campo Contraseña está vacío',
                'password.min'=>'El campo Contraseña debe tener al menos 6 caracteres'
            ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //$credentials = $request->only('email', 'password');
        $credentials = [
            'email' => strtolower($request->correo),
            'password' => $request->password,
        ];
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return response()->json(['token' => $token]);
    }

    // Ruta protegida
    public function me()
    {
        return response()->json(auth()->user());
    }
 
}
