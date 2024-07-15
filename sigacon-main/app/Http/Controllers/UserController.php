<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class UserController extends Controller
{
    // Función para mostrar la lista de usuarios
    public function index()
    {
        $users = User::all();
        $user = Auth::user();
        return view('superUsuario.adminUsers', compact('users'), ['user' => $user]);
    }

    // Función para mostrar el formulario de creación de usuario
    public function create()
    {
        $roles = [
            'superUsuario',
            'contador',
            'administrador',
            'repreLegal',
            'juntaDirectiva',
            'revisorFiscal',
            'propietario',
            'proveedor',
            'cliente',
            'inmobiliaria',
            'normalUser'
        ];

        $document_types = [
            'Cedula de Ciudadania',
            'Cedula de Extranjeria',
            'Pasaporte',
            'Tarjeta Identidad',
            'Nit'
        ];

        $autoretenedor_rentas = [
            'Si',
            'No'
        ];

        $autoretenedor_ivas = [
            'Si',
            'No'
        ];

        $autoretenedor_icas = [
            'Si',
            'No'
        ];

        $responsable_ivas = [
            'Si',
            'No'
        ];

        $declarante_rstss = [
            'Si',
            'No'
        ];

        $declarante_rentas = [
            'Si',
            'No'
        ];


        $countries = Country::all();
        $states = State::all();
        $cities = City::where('state_id', $states->first()->id)->get();


        return view('superUsuario.editUsers', compact('roles', 'document_types', 'autoretenedor_rentas', 'autoretenedor_ivas', 'autoretenedor_icas', 'responsable_ivas', 'declarante_rstss', 'declarante_rentas', 'countries', 'states', 'cities'));

    }

    // Función para guardar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'sometimes|string|max:255', // Primer nombre
            'second_name' => 'nullable|string|max:255', // Segundo nombre (opcional)
            'first_lastname' => 'sometimes|string|max:255', // Primer apellido
            'second_lastname' => 'nullable|string|max:255', // Segundo apellido (opcional)
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|string|in:normalUser,contador,administrador,repreLegal,juntaDirectiva,revisorFiscal,propietario,proveedor,cliente,inmobiliaria,superUsuario', // Define los roles permitidos aquí
            'document_type' => 'required|string|in:Cedula de Ciudadania,Cedula de Extranjeria,Pasaporte,Tarjeta Identidad, Nit',
            'identification_number' => 'required|string|min:6',
            'social_reason' => 'nullable|string|max:255',
            'trade_name' => 'nullable|string|max:255',
            'physical_address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'cellphone' => 'nullable|string|max:15',
            'autoretenedor_renta' => 'nullable|string|in:Si,No',
            'autoretenedor_iva' => 'nullable|string|in:Si,No',
            'autoretenedor_ica' => 'nullable|string|in:Si,No',
            'responsable_iva' => 'nullable|string|in:Si,No',
            'declarante_rsts' => 'nullable|string|in:Si,No',
            'declarante_renta' => 'nullable|string|in:Si,No',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'first_lastname' => $request->first_lastname,
            'second_lastname' => $request->second_lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
            'document_type' => $request->document_type,
            'identification_number' => $request->identification_number,
            'social_reason' => $request->social_reason,
            'trade_name' => $request->trade_name,
            'physical_address' => $request->physical_address,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'autoretenedor_renta' => $request->autoretenedor_renta,
            'autoretenedor_iva' => $request->autoretenedor_iva,
            'autoretenedor_ica' => $request->autoretenedor_ica,
            'responsable_iva' => $request->responsable_iva,
            'declarante_rsts' => $request->declarante_rsts,
            'declarante_renta' => $request->declarante_renta,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
        ]);

        

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Función para eliminar un usuario de la base de datos
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function edit(User $user)  //para editar la info del usuario
{
    $roles = [
        'superUsuario',
        'contador',
        'administrador',
        'repreLegal',
        'juntaDirectiva',
        'revisorFiscal',
        'propietario',
        'proveedor',
        'cliente',
        'inmobiliaria',
        'normalUser'
    ];
    
    $document_types = [
        'Cedula de Ciudadania',
        'Cedula de Extranjeria',
        'Pasaporte',
        'Tarjeta Identidad',
        'Nit'
    ];

    $autoretenedor_rentas = [
        'Si',
        'No'
    ];

    $autoretenedor_ivas = [
        'Si',
        'No'
    ];

    $autoretenedor_icas = [
        'Si',
        'No'
    ];

    $responsable_ivas = [
        'Si',
        'No'
    ];

    $declarante_rstss = [
        'Si',
        'No'
    ];

    $declarante_rentas = [
        'Si',
        'No'
    ];

    $countries = Country::all();
    $states = State::all();
    $cities = City::where('state_id', $user->state_id)->get();


    return view('superUsuario.editUser', compact('user', 'roles', 'document_types', 'autoretenedor_rentas', 'autoretenedor_ivas', 'autoretenedor_icas', 'responsable_ivas', 'declarante_rstss', 'declarante_rentas', 'countries', 'states', 'cities'));


}

public function update(Request $request, User $user) //para actualizar la info editada del usuario
{

    $request->validate([
        'first_name' => 'required|string|max:255',
        'second_name' => 'nullable|string|max:255',
        'first_lastname' => 'required|string|max:255',
        'second_lastname' => 'nullable|string|max:255',
        'email' => 'required|email|unique:user,email,'.$user->id,
        'rol' => 'required|string|in:superUsuario,contador,administrador,repreLegal,juntaDirectiva,revisorFiscal,propietario,proveedor,cliente,inmobiliaria,normalUser', // Define los roles permitidos aquí
        'document_type' => 'required|string|in:Cedula de Ciudadania,Cedula de Extranjeria,Pasaporte,Tarjeta Identidad, Nit',
        'identification_number' => 'required|string',
        'social_reason' => 'nullable|string|max:255',
        'trade_name' => 'nullable|string|max:255',
        'physical_address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:15',
        'cellphone' => 'nullable|string|max:15',
        'autoretenedor_renta' => 'nullable|string|in:Si,No',
        'autoretenedor_iva' => 'nullable|string|in:Si,No',
        'autoretenedor_ica' => 'nullable|string|in:Si,No',
        'responsable_iva' => 'nullable|string|in:Si,No',
        'declarante_rsts' => 'nullable|string|in:Si,No',
        'declarante_renta' => 'nullable|string|in:Si,No',
        'country_id' => 'required|exists:countries,id',
        'state_id' => 'required|exists:states,id',
        'city_id' => 'required|exists:cities,id',
    ]);

    $user->update([
        'first_name' => $request->first_name,
        'second_name' => $request->second_name,
        'first_lastname' => $request->first_lastname,
        'second_lastname' => $request->second_lastname,
        'email' => $request->email,
        'rol' => $request->rol,
        'document_type' => $request->document_type,
        'identification_number' => $request->identification_number,
        'social_reason' => $request->social_reason,
        'trade_name' => $request->trade_name,
        'physical_address' => $request->physical_address,
        'phone' => $request->phone,
        'cellphone' => $request->cellphone,
        'autoretenedor_renta' => $request->autoretenedor_renta,
        'autoretenedor_iva' => $request->autoretenedor_iva,
        'autoretenedor_ica' => $request->autoretenedor_ica,
        'responsable_iva' => $request->responsable_iva,
        'declarante_rsts' => $request->declarante_rsts,
        'declarante_renta' => $request->declarante_renta,
        'country_id' => $request->country_id,
        'state_id' => $request->state_id,
        'city_id' => $request->city_id,
    ]);

    return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
}

public function toggle(User $user) //Para habilitar o inhabilitar un usuario
{
    $user->active = !$user->active;
    $user->save();

    return redirect()->back()->with('success', 'Estado del usuario actualizado correctamente.');
}


public function getStates($country_id)
{
    $states = State::where('country_id', $country_id)->pluck('name', 'id');
    return response()->json($states);
}

public function getCities($state_id)
{
    $cities = City::where('state_id', $state_id)->pluck('name', 'id');
    return response()->json($cities);
}



}