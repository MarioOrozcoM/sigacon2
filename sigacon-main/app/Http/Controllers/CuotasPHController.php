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
        $cuotasPH = CuotaPH::with('concepto', 'unidades.empresa')->get();
        return view('superUsuario.propiedadHorizontal.cuotas.indexCuota', compact('cuotasPH'));
    }

    // Mostrar formulario para crear una nueva cuotaPH
    public function create()
    {
        $conceptos = Concepto::all();
        $empresas = Empresa::where('tipo_empresa', 'Propiedad Horizontal')->get();
        // Inicialmente no traemos unidades hasta que se seleccione una empresa
        $unidades = [];
    
        return view('superUsuario.propiedadHorizontal.cuotas.createCuota', compact('conceptos', 'empresas', 'unidades'));
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