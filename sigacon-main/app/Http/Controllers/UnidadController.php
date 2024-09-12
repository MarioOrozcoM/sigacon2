<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidad;
use App\Models\Empresa;

class UnidadController extends Controller
{
    /**
     * Muestra la lista de unidades.
     */
    public function index(Request $request)
    {
        // Obtener las empresas de tipo "Propiedad Horizontal"
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
    
        // Obtener solo las unidades de la empresa seleccionada, si hay una selección
        $unidades = Unidad::with('empresa')
            ->when($request->empresa_id, function ($query) use ($request) {
                $query->where('empresa_id', $request->empresa_id);
            })
            ->get();
    
        return view('superUsuario.propiedadHorizontal.unidades.adminUnidades', compact('empresas', 'unidades'));
    }
    
    

    /**
     * Muestra el formulario para crear una nueva unidad.
     */
    public function create(Request $request)
    {
        // Obtener la empresa seleccionada basada en 'empresa_id'
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
    
        // Pasar la empresa seleccionada a la vista
        return view('superUsuario.propiedadHorizontal.unidades.createUnidad', compact('empresa'));
    }
    

    /**
     * Guarda una nueva unidad en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipoUnidad' => 'required|string|max:255',
            'torreBloque' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'matriculaInmobiliaria' => 'required|string|max:255',
            'fichaCatastral' => 'required|string|max:255',
            'areaMt2' => 'required|numeric',
            'propietario' => 'required|string|max:255',
            'garaje' => 'required|string|max:255',
            'porcentajeUnidad' => 'required|numeric',
            'totalCoeficiente' => 'required|numeric',
            'empresa_id' => 'required|exists:empresas,id', // Validar que la empresa seleccionada exista
        ]);

        Unidad::create($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una unidad existente.
     */
    public function edit(Unidad $unidad)
    {
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get(); // Filtrar empresas
        return view('superUsuario.propiedadHorizontal.unidades.editUnidad', compact('unidad', 'empresas'));
    }
    

    /**
     * Actualiza una unidad existente en la base de datos.
     */
    public function update(Request $request, Unidad $unidad)
    {
        $request->validate([
            'tipoUnidad' => 'required|string|max:255',
            'torreBloque' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'matriculaInmobiliaria' => 'required|string|max:255',
            'fichaCatastral' => 'required|string|max:255',
            'areaMt2' => 'required|numeric',
            'propietario' => 'required|string|max:255',
            'garaje' => 'required|string|max:255',
            'porcentajeUnidad' => 'required|numeric',
            'totalCoeficiente' => 'required|numeric',
            'empresa_id' => 'required|exists:empresas,id', // Validar la existencia de la empresa
        ]);

        $unidad->update($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad actualizada exitosamente.');
    }

    /**
     * Elimina una unidad de la base de datos.
     */
    public function destroy(Unidad $unidad)
    {
        $unidad->delete();

        return redirect()->route('unidades.index')->with('success', 'Unidad eliminada exitosamente.');
    }
}
