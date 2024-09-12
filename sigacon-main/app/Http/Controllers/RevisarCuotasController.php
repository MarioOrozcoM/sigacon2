<?php

namespace App\Http\Controllers;

use App\Models\CuotaAdministracion;
use App\Models\Empresa;
use App\Models\Unidad;
use Illuminate\Http\Request;

class RevisarCuotasController extends Controller
{
    // Mostrar todas las empresas de tipo Propiedad Horizontal
    public function showEmpresas()
    {
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
        return view('superUsuario.propiedadHorizontal.adminCuotasAdministracion.listEmpresas', compact('empresas'));
    }

    // Mostrar unidades de la empresa seleccionada y sus cuotas
    public function showUnidades(Empresa $empresa)
    {
        $unidades = $empresa->unidades()->with('cuotas')->get(); // Asegúrate de cargar las cuotas relacionadas
        return view('superUsuario.propiedadHorizontal.adminCuotasAdministracion.showUnidades', compact('empresa', 'unidades'));
    }

    // Eliminar cuota asignada a una unidad
    public function removeCuota(Request $request, Empresa $empresa, Unidad $unidad)
    {
        // Obtener el ID de la cuota desde el formulario
        $cuotaId = $request->input('cuota_id');
    
        // Eliminar la relación entre la unidad y la cuota en la tabla intermedia cuota_unidad
        $unidad->cuotas()->detach($cuotaId);
    
        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Cuota eliminada correctamente.');
    }
    
}
