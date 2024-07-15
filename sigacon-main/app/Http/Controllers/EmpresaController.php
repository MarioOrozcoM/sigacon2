<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    // Función para mostrar la lista de empresas
    public function index()
    {
        $empresas = Empresa::all();
        $empresa = $empresas;
        return view('superUsuario.empresas.adminEmpresas', compact('empresas'), ['empresa' => $empresa]);
    }

    // Función para mostrar el formulario de creación de empresa
    public function create()
    {

        $tiposEmpresa = ['Comercial', 'Servicios', 'Propiedad Horizontal', 'Asociacion', 'Salud', 'Industrial', 'Fundacion'];
        $tamanosEmpresa = ['Grande', 'Mediana', 'Pequeña', 'Micro'];

        return view('superUsuario.empresas.createEmpresa', compact('tiposEmpresa', 'tamanosEmpresa'));
    }

    // Función para guardar una nueva empresa en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            // Define las reglas de validación según tus necesidades
        'codigo_empresa' => 'nullable|string|max:45',
        'tipo_empresa' => 'required|string|in:Comercial,Servicios,Propiedad Horizontal,Asociacion,Salud,Industrial,Fundacion',
        'numero_identificacion' => 'nullable|string|max:15',
        'persona_juridica' => 'nullable|string|max:10',
        'primer_nombre' => 'nullable|string|max:30',
        'segundo_nombre' => 'nullable|string|max:30',
        'primer_apellido' => 'nullable|string|max:30',
        'segundo_apellido' => 'nullable|string|max:30',
        'razon_social' => 'nullable|string|max:250',
        'nombre_comercial' => 'nullable|string|max:100',
        'numero_identificacion_repre' => 'nullable|string|max:15',
        'fecha_inicio_repre' => 'nullable|date',
        'numero_acta_repre' => 'nullable|string|max:20',
        'numero_identificacion_suplente' => 'nullable|string|max:15',
        'fecha_inicio_suplente' => 'nullable|date',
        'numero_acta_suplente' => 'nullable|string|max:20',
        'numero_identificacion_contador' => 'nullable|string|max:15',
        'fecha_inicio_contador' => 'nullable|date',
        'tarjeta_profesional_contador' => 'nullable|string|max:30',
        'numero_identificacion_revisor' => 'nullable|string|max:15',
        'fecha_inicio_revisor' => 'nullable|date',
        'tarjeta_profesional_revisor' => 'nullable|string|max:30',
        'numero_acta_revisor' => 'nullable|string|max:20',
        'numero_identificacion_socio' => 'nullable|string|max:15',
        'fecha_registro_socio' => 'nullable|date',
        'numero_acciones' => 'nullable|string|max:15',
        'numero_titulo' => 'nullable|string|max:10',
        'numero_resolucion' => 'nullable|string|max:15',
        'fecha_resolucion' => 'nullable|date',
        'rangos_numeracion' => 'nullable|string|max:20',
        'observaciones' => 'nullable|string|max:250',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tamano_empresa' => 'nullable|string|in:Grande,Mediana,Pequeña,Micro',
        ]);

        $data = $request->all();

        // Manejar la subida del archivo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            // Guardar la imagen en la carpeta public/images
            if ($file->move(public_path('images'), $nombreArchivo)) {
                // Guardar la ruta relativa en la base de datos
                $data['logo'] = '/images/' . $nombreArchivo;
            } else {
                return redirect()->back()->withErrors(['logo' => 'Error al subir la imagen']);
            }
        }
            


        // Crear una nueva empresa
        Empresa::create($data);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa creada correctamente.');
    }

    // Función para mostrar el formulario de edición de empresa
    public function edit(Empresa $empresa)
    {

        $tiposEmpresa = ['Comercial', 'Servicios', 'Propiedad Horizontal', 'Asociacion', 'Salud', 'Industrial', 'Fundacion'];
        $tamanosEmpresa = ['Grande', 'Mediana', 'Pequeña', 'Micro'];        

        return view('superUsuario.empresas.editEmpresa', compact('empresa', 'tiposEmpresa', 'tamanosEmpresa'));
    }

    // Función para actualizar una empresa en la base de datos
    public function update(Request $request, Empresa $empresa)
    {
        // Validar los datos del formulario
        $request->validate([
        // Define las reglas de validación según tus necesidades
        'codigo_empresa' => 'nullable|string|max:45',
        'tipo_empresa' => 'required|string|in:Comercial,Servicios,Propiedad Horizontal,Asociacion,Salud,Industrial,Fundacion',
        'numero_identificacion' => 'nullable|string|max:15',
        'persona_juridica' => 'nullable|string|max:10',
        'primer_nombre' => 'nullable|string|max:30',
        'segundo_nombre' => 'nullable|string|max:30',
        'primer_apellido' => 'nullable|string|max:30',
        'segundo_apellido' => 'nullable|string|max:30',
        'razon_social' => 'nullable|string|max:250',
        'nombre_comercial' => 'nullable|string|max:100',
        'numero_identificacion_repre' => 'nullable|string|max:15',
        'fecha_inicio_repre' => 'nullable|date',
        'numero_acta_repre' => 'nullable|string|max:20',
        'numero_identificacion_suplente' => 'nullable|string|max:15',
        'fecha_inicio_suplente' => 'nullable|date',
        'numero_acta_suplente' => 'nullable|string|max:20',
        'numero_identificacion_contador' => 'nullable|string|max:15',
        'fecha_inicio_contador' => 'nullable|date',
        'tarjeta_profesional_contador' => 'nullable|string|max:30',
        'numero_identificacion_revisor' => 'nullable|string|max:15',
        'fecha_inicio_revisor' => 'nullable|date',
        'tarjeta_profesional_revisor' => 'nullable|string|max:30',
        'numero_acta_revisor' => 'nullable|string|max:20',
        'numero_identificacion_socio' => 'nullable|string|max:15',
        'fecha_registro_socio' => 'nullable|date',
        'numero_acciones' => 'nullable|string|max:15',
        'numero_titulo' => 'nullable|string|max:10',
        'numero_resolucion' => 'nullable|string|max:15',
        'fecha_resolucion' => 'nullable|date',
        'rangos_numeracion' => 'nullable|string|max:20',
        'observaciones' => 'nullable|string|max:250',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tamano_empresa' => 'nullable|string|in:Grande,Mediana,Pequeña,Micro',

        ]);



        $data = $request->all();

        // Verificar si se envió un nuevo archivo de logotipo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            // Guardar la imagen en la carpeta public/images
            if ($file->move(public_path('images'), $nombreArchivo)) {
                // Guardar la ruta relativa en los datos a actualizar
                $data['logo'] = '/images/' . $nombreArchivo;
            } else {
                return redirect()->back()->withErrors(['logo' => 'Error al subir la imagen']);
            }
        } else {
            // Conservar el valor existente del logotipo
            $data['logo'] = $empresa->logo;
        }
    
        // Actualizar la empresa
        $empresa->update($data);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada correctamente.');
    }

    // Función para habilitar o inhabilitar una empresa
    public function toggle(Empresa $empresa)
    {
        $empresa->active = !$empresa->active;
        $empresa->save();

        return redirect()->back()->with('success', 'Estado de la empresa actualizado correctamente.');
    }
}
