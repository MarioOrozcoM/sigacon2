<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Función que muestra la vista de logados o la vista con el formulario de Login
    public function index()
    {
        // Comprobamos si el usuario ya está logado
        if (Auth::check()) {
            // Si está logado le mostramos la vista de logados
            return view('logados');
        }
    
        // Si no está logado le mostramos la vista con el formulario de login
        return view('inicio_sesion');
    }
    
    // Función que se encarga de recibir los datos del formulario de login, comprobar que el usuario existe y en caso correcto logar al usuario
    // Función que se encarga de recibir los datos del formulario de login, comprobar que el usuario existe y en caso correcto logar al usuario
public function login(Request $request)
{
    // Comprobamos que el email y la contraseña han sido introducidos
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    // Almacenamos las credenciales de email y contraseña
    $credentials = $request->only('email', 'password');

    // Si el usuario existe y está activo, lo logamos y lo llevamos a la vista de "logados" con un mensaje
    if (Auth::attempt($credentials) && Auth::user()->active) {
        return redirect()->route('logados')->withSuccess('Logado Correctamente');
    }

    // Si el usuario no existe o no está activo, devolvemos al usuario al formulario de login con un mensaje de error
    return redirect("/")->withErrors(['email' => 'Los datos introducidos no son correctos o tu cuenta está deshabilitada']);
}

    
    private function getUserData() {
        if (Auth::check()) {
            return Auth::user();
        }
        return null;
    }

    // Función que muestra la vista de logados si el usuario está logado y si no le devuelve al formulario de login con un mensaje de error
    public function logados()
    {
        $user = Auth::user();
        return view('logados', ['user' => $user]); //Variable para que el nombre del usuario aparezca cuando se loguea
        if (Auth::check()) {
            return view('logados');
        }
    
        return redirect("/")->withSuccess('No tienes acceso, por favor inicia sesión');
    }

    // Función para mostrar la vista principal
    public function main()  //es para que la variable $user funcione en main.blade
    {
        // Obtenemos la información del usuario
        $user = $this->getUserData();
    
        // Retornamos la vista principal y pasamos la información del usuario a la vista
        return view('main', ['user' => $user]);
    }
    // public function adminUsers()
    // {
    //     $user = $this->getUserData();

    //     return view('superUsuario.adminUsers', ['user' => $user]);
    // }

      public function rol()
      {
        $user = $this->getUserData();

        return view('includes.show_rol', ['user' => $user]);
      }

    }


