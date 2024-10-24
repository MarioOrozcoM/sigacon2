<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\CuotaPH;
use App\Models\Empresa;
use App\Models\Concepto;
use App\Models\CuotaUnidad;
use Illuminate\Http\Request;
use App\Exports\CuotaPHExport;
use Maatwebsite\Excel\Facades\Excel;

class CuotasPHController extends Controller
{
    // Mostrar todas las cuotasPH
    public function index(Request $request)
    {
        // Obtener las empresas para el dropdown
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
        
        // Obtener la empresa seleccionada
        $empresa_id = $request->input('empresa_id');
        
        // Obtener las unidades solo si se selecciona una empresa
        $unidades = [];
        if ($empresa_id) {
            $unidades = Unidad::with('cuotasUnidad.cuotaPH.concepto')
                            ->where('empresa_id', $empresa_id)
                            ->get();
        }
    
        // Obtener las cuotas para mostrar en la tabla
        $cuotasPH = CuotaPH::with('concepto', 'unidades.empresa')->get();
        
        // Verificar si se está editando una cuota
        $cuotaEditar = null;
        $cuota_id = $request->input('cuota_id');
        
        if ($cuota_id) {
            $cuotaEditar = CuotaPH::with('unidades')->findOrFail($cuota_id);
        }
    
        return view('superUsuario.propiedadHorizontal.cuotas.indexCuota', compact('empresas', 'unidades', 'empresa_id', 'cuotasPH', 'cuotaEditar'));
    }
    
    // Mostrar formulario para crear una nueva cuotaPH
    public function create(Request $request)
    {
        $conceptos = Concepto::all();
        $empresa_id = $request->input('empresa_id');

        // Verificar que se haya pasado un empresa_id
        if (!$empresa_id) {
            return redirect()->route('cuotasPH.index')->with('error', 'No se proporcionó una empresa.');
        }

        $empresa = Empresa::findOrFail($empresa_id);
        // Inicialmente no traemos unidades hasta que se seleccione una empresa
        $unidades = [];

        return view('superUsuario.propiedadHorizontal.cuotas.createCuota', compact('conceptos', 'empresa', 'unidades'));
    }

    // Filtrar unidades por empresa seleccionada
    public function getUnidadesByEmpresa($empresaId)
    {
        $unidades = Unidad::where('empresa_id', $empresaId)->get();
        return response()->json($unidades);
    }

    // Guardar la nueva cuota
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'concepto_id' => 'required',
            'vrlIndividual' => 'required|numeric',
            'tipo' => 'required',
            'aNombreDe' => 'required|string|max:255',
            'desde' => 'required|date',
            'hasta' => 'required|date',
            'empresa_id' => 'required',
            'unidad_ids' => 'required|array', // Asegúrate de que sea un array
            'observacion' => 'nullable|string',
        ]);
    
        // Crear la cuota
        $cuota = CuotaPH::create($request->all());
    
        // Asignar unidades a la cuota
        if ($request->has('unidad_ids')) {
            foreach ($request->unidad_ids as $unidadId) {
                if ($unidadId !== 'all') { // Ignorar la opción "Seleccionar Todas"
                    $cuota->unidades()->attach($unidadId);
                }
            }
        }
    
        // Si se seleccionó "Seleccionar Todas", asigna todas las unidades
        if (in_array('all', $request->unidad_ids)) {
            $unidades = Unidad::where('empresa_id', $request->empresa_id)->pluck('id')->toArray();
            $cuota->unidades()->attach($unidades);
        }
    
        return redirect()->route('cuotasPH.index', ['empresa_id' => $request->empresa_id])
            ->with('success', 'Cuota creada exitosamente.');
    }

    // Actualizar una cuotaPH
    public function update(Request $request)
    {
        $request->validate([
            'valores' => 'required|array',
            'valores.*' => 'numeric|min:0',
        ]);
    
        foreach ($request->valores as $cuotaId => $valor) {
            $cuotaPH = CuotaPH::findOrFail($cuotaId);
            $cuotaPH->vrlIndividual = $valor;
            $cuotaPH->save();
        }
    
        // Redirigir a la misma vista con el ID de la empresa
        return redirect()->route('cuotasPH.index', ['empresa_id' => $request->empresa_id])->with('success', 'Los cambios se han guardado correctamente.');
    }
    
    
    

    // Eliminar una cuotaPH
    public function destroy(CuotaPH $cuota)
    {
        $cuota->delete();

        return redirect()->route('cuotasPH.index')->with('success', 'Cuota eliminada con éxito.');
    }

    // Exportar a excel las cuotas de la Copropiedad
    public function export(Request $request)
    {
        $empresaId = $request->input('empresa_id'); // Asegúrate de pasar el ID de la empresa
        $empresa = Empresa::find($empresaId); // Obtén la empresa por ID
    
        // Define el nombre del archivo
        $nombreArchivo = 'cuotas_ph_' . $empresa->razon_social . '.xlsx'; // Asegúrate de sanitizar el nombre si es necesario
    
        return Excel::download(new CuotaPHExport($empresaId), $nombreArchivo);
    }
}
