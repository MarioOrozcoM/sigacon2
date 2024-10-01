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

        // Obtener todas las cuotas
        $cuotasPH = CuotaPH::with('concepto', 'unidades.empresa')->get();

        return view('superUsuario.propiedadHorizontal.cuotas.indexCuota', compact('empresas', 'unidades', 'empresa_id', 'cuotasPH'));
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





    //Filtrar unidades por empresa seleccionada
    public function getUnidadesByEmpresa($empresaId)
    {
        $unidades = Unidad::where('empresa_id', $empresaId)->get();
        return response()->json($unidades);
    }

    //Guardar la nueva cuota
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
    
        return redirect()->route('cuotasPH.index')->with('success', 'Cuota creada exitosamente.');
    }

    // Mostrar formulario para editar una cuotaPH
    public function edit(CuotaPH $cuota)
    {
        $conceptos = Concepto::all();
        $empresa = Empresa::findOrFail($cuota->empresa_id);
        // Trae las unidades asociadas a la empresa para seleccionar
        $unidades = Unidad::where('empresa_id', $empresa->id)->get();
        return view('superUsuario.propiedadHorizontal.cuotas.editCuota', compact('cuota', 'conceptos', 'empresa', 'unidades'));
    }

    // Actualizar una cuotaPH
    public function update(Request $request, $id)
{
    $request->validate([
        'concepto_id' => 'required',
        'vrlIndividual' => 'required|numeric',
        'tipo' => 'required',
        'aNombreDe' => 'required|string|max:255',
        'desde' => 'required|date',
        'hasta' => 'required|date',
        'empresa_id' => 'required',
        'unidad_ids' => 'required|array',
        'observacion' => 'nullable|string',
    ]);

    $cuota = CuotaPH::findOrFail($id);
    $cuota->update($request->all());

    // Sincronizar las unidades
    $unidadIds = $request->unidad_ids;

    if (in_array('all', $unidadIds)) {
        $unidadIds = Unidad::where('empresa_id', $request->empresa_id)->pluck('id')->toArray();
    }

    $cuota->unidades()->sync($unidadIds);

    return redirect()->route('cuotasPH.index')->with('success', 'Cuota actualizada exitosamente.');
}


    // Eliminar una cuotaPH
    public function destroy(CuotaPH $cuota)
    {
        $cuota->delete();

        return redirect()->route('cuotasPH.index')->with('success', 'Cuota eliminada con éxito.');
    }
}