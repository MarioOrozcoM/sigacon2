<?php

namespace App\Http\Controllers;

use App\Models\CuotaAdministracion;
use Illuminate\Http\Request;

class CuotaAdministracionController extends Controller
{
    public function index()
    {
        $cuotas = CuotaAdministracion::all();
        return view('superUsuario.cuotas.adminCuotasAdministracion', compact('cuotas'));
    }

    public function create()
    {
        return view('superUsuario.cuotas.createCuotaAdministracion');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cuotaMensual1' => 'required|numeric',
            'cuotaMensual1SinDescuento' => 'required|numeric',
            'descuento' => 'required|numeric',
            'cuotaMensual2Descuento' => 'required|numeric',
            'diferenciaMensualIncremento' => 'required|numeric',
            'valorRetroactivo' => 'required|numeric',
            'totalPagarSinDescuento' => 'required|numeric',
        ]);

        CuotaAdministracion::create($request->all());

        return redirect()->route('cuotas.index')->with('success', 'Cuota de administración creada correctamente.');
    }

    public function edit(CuotaAdministracion $cuota)
    {
        return view('superUsuario.cuotas.editCuotaAdministracion', compact('cuota'));
    }

    public function update(Request $request, CuotaAdministracion $cuota)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cuotaMensual1' => 'required|string',
            'cuotaMensual1SinDescuento' => 'required|string',
            'descuento' => 'required|string',
            'cuotaMensual2Descuento' => 'required|string',
            'diferenciaMensualIncremento' => 'required|string',
            'valorRetroactivo' => 'required|string',
            'totalPagarSinDescuento' => 'required|string',
        ]);

        $cuota->update($request->all());

        return redirect()->route('cuotas.index')->with('success', 'Cuota de administración actualizada correctamente.');
    }

    public function destroy(CuotaAdministracion $cuota)
    {
        $cuota->delete();

        return redirect()->route('cuotas.index')->with('success', 'Cuota de administración eliminada correctamente.');
    }
}
