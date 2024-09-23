<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use Illuminate\Http\Request;

class ConceptoController extends Controller
{
    // Mostrar lista de conceptos
    public function index()
    {
        $conceptos = Concepto::all();
        return view('superUsuario.propiedadHorizontal.cuotas.conceptos.index', compact('conceptos'));
    }

    // Mostrar formulario para crear un nuevo concepto
    public function create()
    {
        return view('superUsuario.propiedadHorizontal.cuotas.conceptos.create');
    }

    // Guardar un nuevo concepto
    public function store(Request $request)
    {
        $request->validate([
            'nombreConcepto' => 'required|string|max:255',
        ]);

        Concepto::create([
            'nombreConcepto' => $request->nombreConcepto,
        ]);

        return redirect()->route('conceptos.index')->with('success', 'Concepto creado con éxito.');
    }

    // Eliminar un concepto
    public function destroy(Concepto $concepto)
    {
        $concepto->delete();

        return redirect()->route('conceptos.index')->with('success', 'Concepto eliminado con éxito.');
    }
}