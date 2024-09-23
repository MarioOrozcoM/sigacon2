<?php

namespace App\Http\Controllers;

use App\Models\CuotaPH;
use App\Models\Concepto;
use App\Models\Empresa;
use App\Models\Unidad;
use Illuminate\Http\Request;

class CuotasPHController extends Controller
{
    // Mostrar todas las cuotasPH
    public function index()
    {
        $cuotasPH = CuotaPH::with('concepto')->get();
        return view('superUsuario.propiedadHorizontal.cuotas.indexCuota', compact('cuotasPH'));
    }

    // Mostrar formulario para crear una nueva cuotaPH
    public function create()
    {
        $conceptos = Concepto::all();
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
        return view('superUsuario.propiedadHorizontal.cuotas.createCuota', compact('conceptos', 'empresas'));
    }

    // Guardar una nueva cuotaPH
    public function store(Request $request)
    {
        $request->validate([
            'concepto_id' => 'required|exists:conceptos,id',
            'vrlIndividual' => 'required|numeric',
            'tipo' => 'required|string',
            'aNombreDe' => 'nullable|string|max:255',
            'desde' => 'required|date',
            'hasta' => 'nullable|date',
            'observacion' => 'nullable|string|max:255',
            'unidad_ids' => 'array',
            'unidad_ids.*' => 'exists:unidades,id'
        ]);

        // Crear la cuotaPH
        $cuota = CuotaPH::create($request->only([
            'concepto_id',
            'vrlIndividual',
            'tipo',
            'aNombreDe',
            'desde',
            'hasta',
            'observacion'
        ]));

        // Asignar la cuota a las unidades seleccionadas
        if ($request->has('unidad_ids')) {
            foreach ($request->unidad_ids as $unidadId) {
                $cuota->unidades()->attach($unidadId);
            }
        }

        return redirect()->route('cuotasPH.index')->with('success', 'Cuota creada con éxito.');
    }

    // Mostrar formulario para editar una cuotaPH
    public function edit(CuotaPH $cuota)
    {
        $conceptos = Concepto::all();
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
        return view('superUsuario.propiedadHorizontal.cuotas.editCuota', compact('cuota', 'conceptos', 'empresas'));
    }

    // Actualizar una cuotaPH
    public function update(Request $request, CuotaPH $cuota)
    {
        $request->validate([
            'concepto_id' => 'required|exists:conceptos,id',
            'vrlIndividual' => 'required|numeric',
            'tipo' => 'required|string',
            'aNombreDe' => 'nullable|string|max:255',
            'desde' => 'required|date',
            'hasta' => 'nullable|date',
            'observacion' => 'nullable|string|max:255'
        ]);

        $cuota->update($request->only([
            'concepto_id',
            'vrlIndividual',
            'tipo',
            'aNombreDe',
            'desde',
            'hasta',
            'observacion'
        ]));

        return redirect()->route('cuotasPH.index')->with('success', 'Cuota actualizada con éxito.');
    }

    // Eliminar una cuotaPH
    public function destroy(CuotaPH $cuota)
    {
        $cuota->delete();

        return redirect()->route('cuotasPH.index')->with('success', 'Cuota eliminada con éxito.');
    }
}