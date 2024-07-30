<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Copropiedad;
use Illuminate\Support\Facades\DB;

class CopropiedadController extends Controller
{
    // Función para mostrar la lista de copropiedades
    public function index()
    {
        $copropiedades = Copropiedad::all();
        $copropiedad = $copropiedades;
        return view('superUsuario.copropiedades.adminCopropiedades', compact('copropiedades'), ['copropiedad' => $copropiedad]);
    }

        // Función para mostrar el formulario de creación de copropiedad
        public function create()
        {
    
            $tiposUnidad = ['Apartamento', 'Casa', 'Local', 'Lote', 'Garaje', 'Bodega'];
            $nombre_conceptosFacturacion = ['Todos los Conceptos', 'Cuota Ordinaria', 'Cuota Ordinaria Modular',
                'Cuota ExtraOrdinaria', 'Cuota ExtraOrdinaria Modular', 'Intereses de Mora', 'Arriendo', 'Multas y Sanciones',
                'Cuotas Especiales', 'Daños y Bienes', 'Uso zonas comunes', 'Descuento Pronto Pago', 'Descuento por consejero, cuota
                ordinaria y modular', 'Retroactivo cuota ordinaria', 'Retroactivo cuota ordinaria modular', 'Impuesto IVA generado'
            ];
            $aplicarA_conceptosFacturacion = [
                'Todos los conceptos', 'Periodo Aplicacion', 'Expensa total mes',
                'Incremento expensas mes %', 'Modo aplicación', 'Suma total', 'Cuotas expensas', 'Descuento pronto pago'
            ];
    
            return view('superUsuario.copropiedades.createCopropiedad', compact('tiposUnidad', 'nombre_conceptosFacturacion', 'aplicarA_conceptosFacturacion'));
        }

        // Función para guardar una nueva copropiedad en la base de datos
    public function store(Request $request)
    {
        $request->validate([
        'nit_copropiedad' => 'nullable|string|max:50',
        'nombre_copropiedad' => 'nullable|string|max:100',
        'tipo_unidad' => 'nullable|string|in:Apartamento, Casa, Local, Lote, Garaje, Bodega,',
        'torre_bloque' => 'nullable|string|max:15',
        'n°' => 'nullable|string|max:15',
        'matricula_inmobiliaria' => 'nullable|string|max:60',
        'ficha_catastral' => 'nullable|string|max:60',
        'area_mt_cuadrado' => 'nullable|string|max:15',
        'coeficiente_participacion' => 'nullable|string|max:15',
        'propietario1' => 'nullable|string|max:100',
        'propietario2' => 'nullable|string|max:100',
        'inmobiliaria' => 'nullable|string|max:100',
        'arrendatario1' => 'nullable|string|max:100',
        'arrendatario2' => 'nullable|string|max:100',
        'placa_vehiculo' => 'nullable|string|max:15',
        'profesion_oficio' =>'nullable|string|max:50',
        'fecha_inicio_cuotaOrdinaria' =>'nullable|date',
        'fecha_final_cuotaOrdinaria' => 'nullable|date',
        'expensa_total_cuotaOrdinaria' => 'nullable|string|max:50',
        'incremento_expensas_mes_cuotaOrdinaria' => 'nullable|string|max:50',
        'modo_aplicacion_cuotaOrdinaria' => 'nullable|string|max:50',
        'fecha_inicio_ordinariaModular' => 'nullable|date',
        'fecha_final_ordinariaModular' => 'nullable|date',
        'expensa_total_ordinariaModular' => 'nullable|string|max:50',
        'incremento_expensas_mes_ordinariaModular' => 'nullable|string|max:50',
        'modo_aplicacion_ordinariaModular' => 'nullable|string|max:50',
        'fecha_inicio_extraordinaria' => 'nullable|date',
        'fecha_final_extraordinaria' => 'nullable|date',
        'expensa_total_extraordinaria' => 'nullable|string|max:50',
        'incremento_expensas_mes_extraordinaria' => 'nullable|string|max:50',
        'modo_aplicacion_extraordinaria' => 'nullable|string|max:50',
        'fecha_inicio_extraordinariaModular' => 'nullable|date',
        'fecha_final_extraordinariaModular' => 'nullable|date',
        'expensa_total_extraordinariaModular' => 'nullable|string|max:50',
        'incremento_expensas_mes_extraordinariaModular' => 'nullable|string|max:50',
        'modo_aplicacion_extraordinariaModular' => 'nullable|string|max:50',
        'codigo_unidad1' => 'nullable|string|max:50',
        'nombre_unidad1' => 'nullable|string|max:50',
        'coeficiente_unidad1' => 'nullable|string|max:50',
        'cuotaOrdinaria_unidad1' => 'nullable|string|max:50',
        'ordinariaModular_unidad1' => 'nullable|string|max:50',
        'extraordinaria_unidad1' => 'nullable|string|max:50',
        'extraordinariaModular_unidad1' => 'nullable|string|max:50',
        'fechaInicio_descuentoOrdinaria' => 'nullable|date',
        'fecha_final_descuentoOrdinaria' => 'nullable|date',
        'descuento_porcentaje_ordinaria' => 'nullable|string|max:50',
        'valor_fijo_ordinaria' => 'nullable|string|max:50',
        'fechaInicio_descuentoOrdinariaModular' => 'nullable|date',
        'fecha_final_descuentoOrdinariaModular' => 'nullable|date',
        'descuento_porcentaje_ordinariaModular' => 'nullable|string|max:50',
        'valor_fijo_ordinariaModular' => 'nullable|string|max:50',
        'fechaInicio_retroactivoOrdinaria' => 'nullable|date',
        'fechaFinal_retroactivoOrdinaria' => 'nullable|date',
        'nombreUnidad1_retroactivoOrdinaria' => 'nullable|string|max:50',
        'valorUnidad1_retroactivoOrdinaria' => 'nullable|string|max:50',
        'fechaInicio_retroactivoOrdinariaModular' => 'nullable|date',
        'fechaFinal_retroactivoOrdinariaModular' => 'nullable|date',
        'nombreUnidad1_retroactivoOrdinariaModular' => 'nullable|string|max:50',
        'valorUnidad1_retroactivoOrdinariaModular' => 'nullable|string|max:50',
        'fechaInicio_consejeroOrdinaria' => 'nullable|date',
        'fechaFinal_consejeroOrdinaria' => 'nullable|date',
        'descuentoOrdinaria_consejero' => 'nullable|string|max:50',
        'valorFijo_consejeroOrdinaria' => 'nullable|string|max:50',
        'nombreUnidad1_consejeroOrdinaria' => 'nullable|string|max:50',
        'propietarioUnidad1_consejeroOrdinaria' => 'nullable|string|max:100',
        'valorUnidad1_consejeroOrdinaria' => 'nullable|string|max:50',
        'fechaInicio_consejeroOrdinariaModular' => 'nullable|date',
        'fechaFinal_consejeroOrdinariaModular' => 'nullable|date',
        'descuentoOrdinariaModular_consejero' => 'nullable|string|max:50',
        'valorFijo_consejeroOrdinariaModular' => 'nullable|string|max:50',
        'valorUnidad1_consejeroOrdinariaModular' => 'nullable|string|max:50',
        'fechaInicio_conceptoFacturación' => 'nullable|date',
        'fechaFinal_conceptoFacturacion' => 'nullable|date',
        'codigo_conceptoFacturacion' => 'nullable|string|max:50',
        'nombre_conceptoFacturacion' => 'nullable|string|in:Todos los Conceptos,Cuota Ordinaria,Cuota Ordinaria Modular,Cuota ExtraOrdinaria,Cuota ExtraOrdinaria Modular,Intereses de Mora,Arriendo,Multas y Sanciones,Cuotas Especiales,Daños y Bienes,Uso zonas comunes,Descuento Pronto Pago,Descuento por consejero,cuota ordinaria y modular,Retroactivo cuota ordinaria,Retroactivo cuota ordinaria modular,Impuesto IVA generado',
        'valorFijo_conceptoFacturacion' => 'nullable|string|max:50',
        'valorImpuesto_IVAGeneradoPorcentaje' => 'nullable|string|max:50',
        'valorFijoImpuesto_IVAGenerado' => 'nullable|string|max:50',
        'imputacionContable_Db' => 'nullable|string|max:50',
        'imputacionContable_Cr' => 'nullable|string|max:50',
        'aplicarA_conceptoFacturacion' => 'nullable|string|in:Todos los conceptos,Periodo Aplicacion,Expensa total mes,Incremento expensas mes %,Modo aplicación,Suma total,Cuotas expensas,Descuento pronto pago',
        'tasaMensual' => 'nullable|string|max:50',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Copropiedad::create([
        //     'nit_copropiedad' => $request->nit_copropiedad,
        //     'nombre_copropiedad' => $request->nombre_copropiedad,
        //     'tipo_unidad' => $request->tipo_unidad,
        //     'torre_bloque' => $request->torre_bloque,
        //     'n°' => $request->n°,
        //     'matricula_inmobiliaria' => $request->matricula_inmobiliaria,
        //     'ficha_catastral' => $request->ficha_catastral,
        //     'area_mt_cuadrado' => $request->area_mt_cuadrado,
        //     'coeficiente_participacion' => $request->coeficiente_participacion,
        //     'propietario1' => $request->propietario1,
        //     'propietario2' => $request->propietario2,
        //     'inmobiliaria' => $request->inmobiliaria,
        //     'arrendatario1' => $request->arrendatario1,
        //     'arrendatario2' => $request->arrendatario2,
        //     'placa_vehiculo' => $request->placa_vehiculo,
        //     'profesion_oficio' => $request->profesion_oficio,
        //     'fecha_inicio_cuotaOrdinaria' => $request->fecha_inicio_cuotaOrdinaria,
        //     'fecha_final_cuotaOrdinaria' => $request->fecha_final_cuotaOrdinaria,
        //     'expensa_total_cuotaOrdinaria' => $request->expensa_total_cuotaOrdinaria,
        //     'incremento_expensas_mes_cuotaOrdinaria' => $request->incremento_expensas_mes_cuotaOrdinaria,
        //     'modo_aplicacion_cuotaOrdinaria' => $request->modo_aplicacion_cuotaOrdinaria,
        //     'fecha_inicio_ordinariaModular' => $request->fecha_inicio_ordinariaModular,
        //     'fecha_final_ordinariaModular' => $request->fecha_final_ordinariaModular,
        //     'expensa_total_ordinariaModular' => $request->expensa_total_ordinariaModular,
        //     'incremento_expensas_mes_ordinariaModular' => $request->incremento_expensas_mes_ordinariaModular,
        //     'modo_aplicacion_ordinariaModular' => $request->modo_aplicacion_ordinariaModular,
        //     'fecha_inicio_extraordinaria' => $request->fecha_inicio_extraordinaria,
        //     'fecha_final_extraordinaria' => $request->fecha_final_extraordinaria,
        //     'expensa_total_extraordinaria' => $request->expensa_total_extraordinaria,
        //     'incremento_expensas_mes_extraordinaria' => $request->incremento_expensas_mes_extraordinaria,
        //     'modo_aplicacion_extraordinaria' => $request->modo_aplicacion_extraordinaria,
        //     'fecha_inicio_extraordinariaModular' => $request->fecha_inicio_extraordinariaModular,
        //     'fecha_final_extraordinariaModular' => $request->fecha_final_extraordinariaModular,
        //     'expensa_total_extraordinariaModular' => $request->expensa_total_extraordinariaModular,
        //     'incremento_expensas_mes_extraordinariaModular' => $request->incremento_expensas_mes_extraordinariaModular,
        //     'modo_aplicacion_extraordinariaModular' => $request->modo_aplicacion_extraordinariaModular,
        //     'codigo_unidad1' => $request->codigo_unidad1,
        //     'nombre_unidad1' => $request->nombre_unidad1,
        //     'coeficiente_unidad1' => $request->coeficiente_unidad1,
        //     'cuotaOrdinaria_unidad1' => $request->cuotaOrdinaria_unidad1,
        //     'ordinariaModular_unidad1' => $request->ordinariaModular_unidad1,
        //     'extraordinaria_unidad1' => $request->extraordinaria_unidad1,
        //     'extraordinariaModular_unidad1' => $request->extraordinariaModular_unidad1,
        //     'fechaInicio_descuentoOrdinaria' => $request->fechaInicio_descuentoOrdinaria,
        //     'fecha_final_descuentoOrdinaria' => $request->fecha_final_descuentoOrdinaria,
        //     'descuento_porcentaje_ordinaria' => $request->descuento_porcentaje_ordinaria,
        //     'valor_fijo_ordinaria' => $request->valor_fijo_ordinaria,
        //     'fechaInicio_descuentoOrdinariaModular' => $request->fechaInicio_descuentoOrdinariaModular,
        //     'fecha_final_descuentoOrdinariaModular' => $request->fecha_final_descuentoOrdinariaModular,
        //     'descuento_porcentaje_ordinariaModular' => $request->descuento_porcentaje_ordinariaModular,
        //     'valor_fijo_ordinariaModular' => $request->valor_fijo_ordinariaModular,
        //     'fechaInicio_retroactivoOrdinaria' => $request->fechaInicio_retroactivoOrdinaria,
        //     'fechaFinal_retroactivoOrdinaria' => $request->fechaFinal_retroactivoOrdinaria,
        //     'nombreUnidad1_retroactivoOrdinaria' => $request->nombreUnidad1_retroactivoOrdinaria,
        //     'valorUnidad1_retroactivoOrdinaria' => $request->valorUnidad1_retroactivoOrdinaria,
        //     'fechaInicio_retroactivoOrdinariaModular' => $request->fechaInicio_retroactivoOrdinariaModular,
        //     'fechaFinal_retroactivoOrdinariaModular' => $request->fechaFinal_retroactivoOrdinariaModular,
        //     'nombreUnidad1_retroactivoOrdinariaModular' => $request->nombreUnidad1_retroactivoOrdinariaModular,
        //     'valorUnidad1_retroactivoOrdinariaModular' => $request->valorUnidad1_retroactivoOrdinariaModular,
        //     'fechaInicio_consejeroOrdinaria' => $request->fechaInicio_consejeroOrdinaria,
        //     'fechaFinal_consejeroOrdinaria' => $request->fechaFinal_consejeroOrdinaria,
        //     'descuentoOrdinaria_consejero' => $request->descuentoOrdinaria_consejero,
        //     'valorFijo_consejeroOrdinaria' => $request->valorFijo_consejeroOrdinaria,
        //     'nombreUnidad1_consejeroOrdinaria' => $request->nombreUnidad1_consejeroOrdinaria,
        //     'propietarioUnidad1_consejeroOrdinaria' => $request->propietarioUnidad1_consejeroOrdinaria,
        //     'valorUnidad1_consejeroOrdinaria' => $request->valorUnidad1_consejeroOrdinaria,
        //     'fechaInicio_consejeroOrdinariaModular' => $request->fechaInicio_consejeroOrdinariaModular,
        //     'fechaFinal_consejeroOrdinariaModular' => $request->fechaFinal_consejeroOrdinariaModular,
        //     'descuentoOrdinariaModular_consejero' => $request->descuentoOrdinariaModular_consejero,
        //     'valorFijo_consejeroOrdinariaModular' => $request->valorFijo_consejeroOrdinariaModular,
        //     'valorUnidad1_consejeroOrdinariaModular' => $request->valorUnidad1_consejeroOrdinariaModular,
        //     'fechaInicio_conceptoFacturación' => $request->fechaInicio_conceptoFacturación,
        //     'fechaFinal_conceptoFacturacion' => $request->fechaFinal_conceptoFacturacion,
        //     'codigo_conceptoFacturacion' => $request->codigo_conceptoFacturacion,
        //     'nombre_conceptoFacturacion' => $request->nombre_conceptoFacturacion,
        //     'valorFijo_conceptoFacturacion' => $request->valorFijo_conceptoFacturacion,
        //     'valorImpuesto_IVAGeneradoPorcentaje' => $request->valorImpuesto_IVAGeneradoPorcentaje,
        //     'valorFijoImpuesto_IVAGenerado' => $request->valorFijoImpuesto_IVAGenerado,
        //     'imputacionContable_Db' => $request->imputacionContable_Db,
        //     'imputacionContable_Cr' => $request->imputacionContable_Cr,
        //     'aplicarA_conceptoFacturacion' => $request->aplicarA_conceptoFacturacion,
        //     'tasaMensual' => $request->tasaMensual,
        // ]);

        $data = $request->all();

        // Manejar la subida del archivo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            // Guardar la imagen en la carpeta public/images
            if ($file->move(public_path('images'), $nombreArchivo)) {
                // Guardar la ruta relativa en la base de datos
                $data['logo'] = '/images/' . $nombreArchivo;
            } else {
                return redirect()->back()->withErrors(['logo' => 'Error al subir la imagen']);
            }
        }
            


        // Crear una nueva copropiedad
        Copropiedad::create($data);

                

        return redirect()->route('copropiedades.index')->with('success', 'Copropiedad creada correctamente.');
    }
    

    //Función para editar la info de la copropiedad
    public function edit(Copropiedad $copropiedad)  
    {
        $tiposUnidad = ['Apartamento', 'Casa', 'Local', 'Lote', 'Garaje', 'Bodega'];
            $nombre_conceptosFacturacion = [
                'Todos los Conceptos', 'Cuota Ordinaria', 'Cuota Ordinaria Modular',
                'Cuota ExtraOrdinaria', 'Cuota ExtraOrdinaria Modular', 'Intereses de Mora', 'Arriendo', 'Multas y Sanciones',
                'Cuotas Especiales', 'Daños y Bienes', 'Uso zonas comunes', 'Descuento Pronto Pago', 'Descuento por consejero, cuota
                ordinaria y modular', 'Retroactivo cuota ordinaria', 'Retroactivo cuota ordinaria modular', 'Impuesto IVA generado'
            ];
            $aplicarA_conceptosFacturacion = [
                'Todos los conceptos', 'Periodo Aplicacion', 'Expensa total mes',
                'Incremento expensas mes %', 'Modo aplicación', 'Suma total', 'Cuotas expensas', 'Descuento pronto pago'
            ];


        return view('superUsuario.copropiedades.editCopropiedad', compact('copropiedad', 'tiposUnidad', 'nombre_conceptosFacturacion', 'aplicarA_conceptosFacturacion'));

    }

        //Función para actualizar una copropiedad en la base de datos
        public function update(Request $request, Copropiedad $copropiedad) 
    {

        $request->validate([
            'nit_copropiedad' => 'nullable|string|max:50',
            'nombre_copropiedad' => 'nullable|string|max:100',
            'tipo_unidad' => 'nullable|string|in:Apartamento, Casa, Local, Lote, Garaje, Bodega,',
            'torre_bloque' => 'nullable|string|max:15',
            'n°' => 'nullable|string|max:15',
            'matricula_inmobiliaria' => 'nullable|string|max:60',
            'ficha_catastral' => 'nullable|string|max:60',
            'area_mt_cuadrado' => 'nullable|string|max:15',
            'coeficiente_participacion' => 'nullable|string|max:15',
            'propietario1' => 'nullable|string|max:100',
            'propietario2' => 'nullable|string|max:100',
            'inmobiliaria' => 'nullable|string|max:100',
            'arrendatario1' => 'nullable|string|max:100',
            'arrendatario2' => 'nullable|string|max:100',
            'placa_vehiculo' => 'nullable|string|max:15',
            'profesion_oficio' =>'nullable|string|max:50',
            'fecha_inicio_cuotaOrdinaria' =>'nullable|date',
            'fecha_final_cuotaOrdinaria' => 'nullable|date',
            'expensa_total_cuotaOrdinaria' => 'nullable|string|max:50',
            'incremento_expensas_mes_cuotaOrdinaria' => 'nullable|string|max:50',
            'modo_aplicacion_cuotaOrdinaria' => 'nullable|string|max:50',
            'fecha_inicio_ordinariaModular' => 'nullable|date',
            'fecha_final_ordinariaModular' => 'nullable|date',
            'expensa_total_ordinariaModular' => 'nullable|string|max:50',
            'incremento_expensas_mes_ordinariaModular' => 'nullable|string|max:50',
            'modo_aplicacion_ordinariaModular' => 'nullable|string|max:50',
            'fecha_inicio_extraordinaria' => 'nullable|date',
            'fecha_final_extraordinaria' => 'nullable|date',
            'expensa_total_extraordinaria' => 'nullable|string|max:50',
            'incremento_expensas_mes_extraordinaria' => 'nullable|string|max:50',
            'modo_aplicacion_extraordinaria' => 'nullable|string|max:50',
            'fecha_inicio_extraordinariaModular' => 'nullable|date',
            'fecha_final_extraordinariaModular' => 'nullable|date',
            'expensa_total_extraordinariaModular' => 'nullable|string|max:50',
            'incremento_expensas_mes_extraordinariaModular' => 'nullable|string|max:50',
            'modo_aplicacion_extraordinariaModular' => 'nullable|string|max:50',
            'codigo_unidad1' => 'nullable|string|max:50',
            'nombre_unidad1' => 'nullable|string|max:50',
            'coeficiente_unidad1' => 'nullable|string|max:50',
            'cuotaOrdinaria_unidad1' => 'nullable|string|max:50',
            'ordinariaModular_unidad1' => 'nullable|string|max:50',
            'extraordinaria_unidad1' => 'nullable|string|max:50',
            'extraordinariaModular_unidad1' => 'nullable|string|max:50',
            'fechaInicio_descuentoOrdinaria' => 'nullable|date',
            'fecha_final_descuentoOrdinaria' => 'nullable|date',
            'descuento_porcentaje_ordinaria' => 'nullable|string|max:50',
            'valor_fijo_ordinaria' => 'nullable|string|max:50',
            'fechaInicio_descuentoOrdinariaModular' => 'nullable|date',
            'fecha_final_descuentoOrdinariaModular' => 'nullable|date',
            'descuento_porcentaje_ordinariaModular' => 'nullable|string|max:50',
            'valor_fijo_ordinariaModular' => 'nullable|string|max:50',
            'fechaInicio_retroactivoOrdinaria' => 'nullable|date',
            'fechaFinal_retroactivoOrdinaria' => 'nullable|date',
            'nombreUnidad1_retroactivoOrdinaria' => 'nullable|string|max:50',
            'valorUnidad1_retroactivoOrdinaria' => 'nullable|string|max:50',
            'fechaInicio_retroactivoOrdinariaModular' => 'nullable|date',
            'fechaFinal_retroactivoOrdinariaModular' => 'nullable|date',
            'nombreUnidad1_retroactivoOrdinariaModular' => 'nullable|string|max:50',
            'valorUnidad1_retroactivoOrdinariaModular' => 'nullable|string|max:50',
            'fechaInicio_consejeroOrdinaria' => 'nullable|date',
            'fechaFinal_consejeroOrdinaria' => 'nullable|date',
            'descuentoOrdinaria_consejero' => 'nullable|string|max:50',
            'valorFijo_consejeroOrdinaria' => 'nullable|string|max:50',
            'nombreUnidad1_consejeroOrdinaria' => 'nullable|string|max:50',
            'propietarioUnidad1_consejeroOrdinaria' => 'nullable|string|max:100',
            'valorUnidad1_consejeroOrdinaria' => 'nullable|string|max:50',
            'fechaInicio_consejeroOrdinariaModular' => 'nullable|date',
            'fechaFinal_consejeroOrdinariaModular' => 'nullable|date',
            'descuentoOrdinariaModular_consejero' => 'nullable|string|max:50',
            'valorFijo_consejeroOrdinariaModular' => 'nullable|string|max:50',
            'valorUnidad1_consejeroOrdinariaModular' => 'nullable|string|max:50',
            'fechaInicio_conceptoFacturación' => 'nullable|date',
            'fechaFinal_conceptoFacturacion' => 'nullable|date',
            'codigo_conceptoFacturacion' => 'nullable|string|max:50',
            'nombre_conceptoFacturacion' => 'nullable|string|in:Todos los Conceptos,Cuota Ordinaria,Cuota Ordinaria Modular,Cuota ExtraOrdinaria,Cuota ExtraOrdinaria Modular,Intereses de Mora,Arriendo,Multas y Sanciones,Cuotas Especiales,Daños y Bienes,Uso zonas comunes,Descuento Pronto Pago,Descuento por consejero,cuota ordinaria y modular,Retroactivo cuota ordinaria,Retroactivo cuota ordinaria modular,Impuesto IVA generado',
            'valorFijo_conceptoFacturacion' => 'nullable|string|max:50',
            'valorImpuesto_IVAGeneradoPorcentaje' => 'nullable|string|max:50',
            'valorFijoImpuesto_IVAGenerado' => 'nullable|string|max:50',
            'imputacionContable_Db' => 'nullable|string|max:50',
            'imputacionContable_Cr' => 'nullable|string|max:50',
            'aplicarA_conceptoFacturacion' => 'nullable|string|in:Todos los conceptos,Periodo Aplicacion,Expensa total mes,Incremento expensas mes %,Modo aplicación,Suma total,Cuotas expensas,Descuento pronto pago',
            'tasaMensual' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // $copropiedad->update([
        //     'nit_copropiedad' => $request->nit_copropiedad,
        //     'nombre_copropiedad' => $request->nombre_copropiedad,
        //     'tipo_unidad' => $request->tipo_unidad,
        //     'torre_bloque' => $request->torre_bloque,
        //     'n°' => $request->n°,
        //     'matricula_inmobiliaria' => $request->matricula_inmobiliaria,
        //     'ficha_catastral' => $request->ficha_catastral,
        //     'area_mt_cuadrado' => $request->area_mt_cuadrado,
        //     'coeficiente_participacion' => $request->coeficiente_participacion,
        //     'propietario1' => $request->propietario1,
        //     'propietario2' => $request->propietario2,
        //     'inmobiliaria' => $request->inmobiliaria,
        //     'arrendatario1' => $request->arrendatario1,
        //     'arrendatario2' => $request->arrendatario2,
        //     'placa_vehiculo' => $request->placa_vehiculo,
        //     'profesion_oficio' => $request->profesion_oficio,
        //     'fecha_inicio_cuotaOrdinaria' => $request->fecha_inicio_cuotaOrdinaria,
        //     'fecha_final_cuotaOrdinaria' => $request->fecha_final_cuotaOrdinaria,
        //     'expensa_total_cuotaOrdinaria' => $request->expensa_total_cuotaOrdinaria,
        //     'incremento_expensas_mes_cuotaOrdinaria' => $request->incremento_expensas_mes_cuotaOrdinaria,
        //     'modo_aplicacion_cuotaOrdinaria' => $request->modo_aplicacion_cuotaOrdinaria,
        //     'fecha_inicio_ordinariaModular' => $request->fecha_inicio_ordinariaModular,
        //     'fecha_final_ordinariaModular' => $request->fecha_final_ordinariaModular,
        //     'expensa_total_ordinariaModular' => $request->expensa_total_ordinariaModular,
        //     'incremento_expensas_mes_ordinariaModular' => $request->incremento_expensas_mes_ordinariaModular,
        //     'modo_aplicacion_ordinariaModular' => $request->modo_aplicacion_ordinariaModular,
        //     'fecha_inicio_extraordinaria' => $request->fecha_inicio_extraordinaria,
        //     'fecha_final_extraordinaria' => $request->fecha_final_extraordinaria,
        //     'expensa_total_extraordinaria' => $request->expensa_total_extraordinaria,
        //     'incremento_expensas_mes_extraordinaria' => $request->incremento_expensas_mes_extraordinaria,
        //     'modo_aplicacion_extraordinaria' => $request->modo_aplicacion_extraordinaria,
        //     'fecha_inicio_extraordinariaModular' => $request->fecha_inicio_extraordinariaModular,
        //     'fecha_final_extraordinariaModular' => $request->fecha_final_extraordinariaModular,
        //     'expensa_total_extraordinariaModular' => $request->expensa_total_extraordinariaModular,
        //     'incremento_expensas_mes_extraordinariaModular' => $request->incremento_expensas_mes_extraordinariaModular,
        //     'modo_aplicacion_extraordinariaModular' => $request->modo_aplicacion_extraordinariaModular,
        //     'codigo_unidad1' => $request->codigo_unidad1,
        //     'nombre_unidad1' => $request->nombre_unidad1,
        //     'coeficiente_unidad1' => $request->coeficiente_unidad1,
        //     'cuotaOrdinaria_unidad1' => $request->cuotaOrdinaria_unidad1,
        //     'ordinariaModular_unidad1' => $request->ordinariaModular_unidad1,
        //     'extraordinaria_unidad1' => $request->extraordinaria_unidad1,
        //     'extraordinariaModular_unidad1' => $request->extraordinariaModular_unidad1,
        //     'fechaInicio_descuentoOrdinaria' => $request->fechaInicio_descuentoOrdinaria,
        //     'fecha_final_descuentoOrdinaria' => $request->fecha_final_descuentoOrdinaria,
        //     'descuento_porcentaje_ordinaria' => $request->descuento_porcentaje_ordinaria,
        //     'valor_fijo_ordinaria' => $request->valor_fijo_ordinaria,
        //     'fechaInicio_descuentoOrdinariaModular' => $request->fechaInicio_descuentoOrdinariaModular,
        //     'fecha_final_descuentoOrdinariaModular' => $request->fecha_final_descuentoOrdinariaModular,
        //     'descuento_porcentaje_ordinariaModular' => $request->descuento_porcentaje_ordinariaModular,
        //     'valor_fijo_ordinariaModular' => $request->valor_fijo_ordinariaModular,
        //     'fechaInicio_retroactivoOrdinaria' => $request->fechaInicio_retroactivoOrdinaria,
        //     'fechaFinal_retroactivoOrdinaria' => $request->fechaFinal_retroactivoOrdinaria,
        //     'nombreUnidad1_retroactivoOrdinaria' => $request->nombreUnidad1_retroactivoOrdinaria,
        //     'valorUnidad1_retroactivoOrdinaria' => $request->valorUnidad1_retroactivoOrdinaria,
        //     'fechaInicio_retroactivoOrdinariaModular' => $request->fechaInicio_retroactivoOrdinariaModular,
        //     'fechaFinal_retroactivoOrdinariaModular' => $request->fechaFinal_retroactivoOrdinariaModular,
        //     'nombreUnidad1_retroactivoOrdinariaModular' => $request->nombreUnidad1_retroactivoOrdinariaModular,
        //     'valorUnidad1_retroactivoOrdinariaModular' => $request->valorUnidad1_retroactivoOrdinariaModular,
        //     'fechaInicio_consejeroOrdinaria' => $request->fechaInicio_consejeroOrdinaria,
        //     'fechaFinal_consejeroOrdinaria' => $request->fechaFinal_consejeroOrdinaria,
        //     'descuentoOrdinaria_consejero' => $request->descuentoOrdinaria_consejero,
        //     'valorFijo_consejeroOrdinaria' => $request->valorFijo_consejeroOrdinaria,
        //     'nombreUnidad1_consejeroOrdinaria' => $request->nombreUnidad1_consejeroOrdinaria,
        //     'propietarioUnidad1_consejeroOrdinaria' => $request->propietarioUnidad1_consejeroOrdinaria,
        //     'valorUnidad1_consejeroOrdinaria' => $request->valorUnidad1_consejeroOrdinaria,
        //     'fechaInicio_consejeroOrdinariaModular' => $request->fechaInicio_consejeroOrdinariaModular,
        //     'fechaFinal_consejeroOrdinariaModular' => $request->fechaFinal_consejeroOrdinariaModular,
        //     'descuentoOrdinariaModular_consejero' => $request->descuentoOrdinariaModular_consejero,
        //     'valorFijo_consejeroOrdinariaModular' => $request->valorFijo_consejeroOrdinariaModular,
        //     'valorUnidad1_consejeroOrdinariaModular' => $request->valorUnidad1_consejeroOrdinariaModular,
        //     'fechaInicio_conceptoFacturación' => $request->fechaInicio_conceptoFacturación,
        //     'fechaFinal_conceptoFacturacion' => $request->fechaFinal_conceptoFacturacion,
        //     'codigo_conceptoFacturacion' => $request->codigo_conceptoFacturacion,
        //     'nombre_conceptoFacturacion' => $request->nombre_conceptoFacturacion,
        //     'valorFijo_conceptoFacturacion' => $request->valorFijo_conceptoFacturacion,
        //     'valorImpuesto_IVAGeneradoPorcentaje' => $request->valorImpuesto_IVAGeneradoPorcentaje,
        //     'valorFijoImpuesto_IVAGenerado' => $request->valorFijoImpuesto_IVAGenerado,
        //     'imputacionContable_Db' => $request->imputacionContable_Db,
        //     'imputacionContable_Cr' => $request->imputacionContable_Cr,
        //     'aplicarA_conceptoFacturacion' => $request->aplicarA_conceptoFacturacion,
        //     'tasaMensual' => $request->tasaMensual,
        // ]);

        $data = $request->all();

        // Verificar si se envió un nuevo archivo de logotipo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            // Guardar la imagen en la carpeta public/images
            if ($file->move(public_path('images'), $nombreArchivo)) {
                // Guardar la ruta relativa en los datos a actualizar
                $data['logo'] = '/images/' . $nombreArchivo;
            } else {
                return redirect()->back()->withErrors(['logo' => 'Error al subir la imagen']);
            }
        } else {
            // Conservar el valor existente del logotipo
            $data['logo'] = $copropiedad->logo;
        }
    
        // Actualizar la copropiedad
        $copropiedad->update($data);

        return redirect()->route('copropiedades.index')->with('success', 'Copropiedad actualizada correctamente.');
    }

    //Función para habilitar o inhabilitar una copropiedad
    public function toggle(Copropiedad $copropiedad) //Para habilitar o inhabilitar un usuario
    {
        $copropiedad->active = !$copropiedad->active;
        $copropiedad->save();

        return redirect()->back()->with('success', 'Estado de la copropiedad actualizada correctamente.');
    }

}
