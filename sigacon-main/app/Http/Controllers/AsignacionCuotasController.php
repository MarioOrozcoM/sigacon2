<?php

namespace App\Http\Controllers;

use App\Models\CuotaAdministracion;
use App\Models\Unidad;
use App\Models\Empresa; // Suponiendo que tienes un modelo Empresa
use Illuminate\Http\Request;

class AsignacionCuotasController extends Controller
{
    public function index()
    {
        // Obtener todas las cuotas de administración y empresas
        $cuotas = CuotaAdministracion::all();
        $empresas = Empresa::where('tipo', 'Propiedad Horizontal')->get(); // Filtrar por tipo si es necesario

        return view('asignacion.index', compact('cuotas', 'empresas'));
    }

    public function seleccionarUnidades(Request $request)
    {
        // Validar que se haya seleccionado una empresa y una cuota
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'cuota_id' => 'required|exists:cuota_administracion,id',
        ]);

        // Obtener la empresa y las unidades de esa empresa
        $empresa = Empresa::findOrFail($request->empresa_id);
        $unidades = Unidad::where('empresa_id', $empresa->id)->get();

        // Obtener la cuota seleccionada
        $cuota = CuotaAdministracion::findOrFail($request->cuota_id);

        return view('asignacion.seleccionar-unidades', compact('empresa', 'unidades', 'cuota'));
    }

    public function asignarCuota(Request $request)
    {
        // Validar que se hayan seleccionado unidades y una cuota
        $request->validate([
            'unidad_ids' => 'required|array',
            'unidad_ids.*' => 'exists:unidades,id',
            'cuota_id' => 'required|exists:cuota_administracion,id',
        ]);

        // Obtener la cuota seleccionada
        $cuota = CuotaAdministracion::findOrFail($request->cuota_id);

        // Asignar la cuota a las unidades seleccionadas
        foreach ($request->unidad_ids as $unidad_id) {
            $unidad = Unidad::findOrFail($unidad_id);
            $unidad->cuota_administracion_id = $cuota->id; // Supongamos que tienes este campo en la tabla unidades
            $unidad->save();
        }

        return redirect()->route('asignacion.index')->with('success', 'Cuota de administración asignada correctamente.');
    }
}
