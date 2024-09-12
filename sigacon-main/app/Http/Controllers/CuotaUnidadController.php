<?php

namespace App\Http\Controllers;

use App\Models\CuotaAdministracion;
use App\Models\Empresa;
use App\Models\Unidad;
use Illuminate\Http\Request;

class CuotaUnidadController extends Controller
{
    // Mostrar todas las cuotas disponibles
    public function showCuotas()
    {
        $cuotas = CuotaAdministracion::all();
        return view('superUsuario.propiedadHorizontal.asignarCuota.indexCuotas', compact('cuotas'));
    }

    // Mostrar las empresas de Propiedad Horizontal para la cuota seleccionada
    public function showEmpresas($cuotaId)
    {
        // Obtener empresas de tipo Propiedad Horizontal
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
    
        // Pasar la variable $cuotaId a la vista
        return view('superUsuario.propiedadHorizontal.asignarCuota.showEmpresas', compact('empresas', 'cuotaId'));
    }
    

// Mostrar las unidades de la empresa seleccionada
public function showUnidades(CuotaAdministracion $cuota, Empresa $empresa)
{
    $unidades = $empresa->unidades; // Asegúrate de que la relación está definida
    $cuotaId = $cuota->id;
    $empresaId = $empresa->id;
    return view('superUsuario.propiedadHorizontal.asignarCuota.showUnidades', compact('cuota', 'empresa', 'unidades', 'cuotaId', 'empresaId'));
}





    // Asignar la cuota seleccionada a las unidades seleccionadas
    public function assignCuota(Request $request)
    {
        // dd($request->all());
        // Validar la solicitud
        $request->validate([
            'cuota_id' => 'required|exists:cuota_administracion,id',
            'empresa_id' => 'required|exists:empresas,id',
            'unidad_ids' => 'array',
            'unidad_ids.*' => 'exists:unidades,id'
        ]);
    
        $cuotaId = $request->input('cuota_id');
        $empresaId = $request->input('empresa_id');
        $unidadIds = $request->input('unidad_ids', []);
    
        // Obtener la cuota y la empresa
        $cuota = CuotaAdministracion::findOrFail($cuotaId);
        $empresa = Empresa::findOrFail($empresaId);
    
        // Verifica que la empresa tenga unidades y asigna la cuota a las unidades seleccionadas
        $unidades = $empresa->unidades()->whereIn('id', $unidadIds)->get();
    
        if ($unidades->isEmpty()) {
            return back()->withErrors(['msg' => 'No se encontraron unidades válidas para asignar.']);
        }
    
        // Asignar la cuota a las unidades
        foreach ($unidadIds as $unidadId) {
            $cuota->unidades()->attach($unidadId); // Asegúrate de que la relación esté definida en el modelo CuotaAdministracion
        }
    
        return redirect()->route('cuotas.show')->with('success', 'Cuota asignada correctamente.');
    }
    
}
