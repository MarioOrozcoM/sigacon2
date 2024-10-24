<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para mostrar el formulario de login
    public function showLoginForm()
    {
        // Verificar si el usuario ya está autenticado
        if (Auth::check()) {
            return redirect()->route('logados'); // Si está autenticado, redirigir a la vista logados
        }

        return view('inicio_sesion'); // Mostrar la vista de login si no está autenticado
    }

    // Función para manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los datos del formulario de inicio de sesión
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Obtener las credenciales
        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials) && Auth::user()->active) {
            return redirect()->route('logados')->withSuccess('Logado Correctamente');
        }

        // Si fallan las credenciales, redirigir con un mensaje de error
        return redirect("/login")->withErrors(['email' => 'Los datos introducidos no son correctos o tu cuenta está deshabilitada']);
    }

    // Función para mostrar la vista de logados
    public function logados()
    {
        $user = Auth::user();
        if (Auth::check()) {
            return view('logados', ['user' => $user]);
        }

        return redirect("/login")->withErrors('No tienes acceso, por favor inicia sesión');
    }

    // Función para mostrar la vista principal
    public function main()
    {
        $user = Auth::user();
        return view('main', ['user' => $user]);
    }

    // Función para mostrar la vista con el rol del usuario
    public function rol()
    {
        $user = Auth::user();
        return view('includes.show_rol', ['user' => $user]);
    }
}
