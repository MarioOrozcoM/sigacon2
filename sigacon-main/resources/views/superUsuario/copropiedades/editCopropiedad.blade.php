<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Copropiedad</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<h2 class="text-xl font-semibold text-center mt-4">Editar Copropiedad</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Inicio Formulario editar copropiedad -->
<div class="container mx-auto px-4 mt-8 mb-6 mr-4 grid grid-cols-2 gap-4">
    <div class="w-3/4"> <!-- Columna izquierda -->
        <form action="{{ route('copropiedades.update', $copropiedad->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2 class="text-xl font-semibold text-center mt-4 mb-4">Datos Copropiedad</h2>
            
            <div class="mb-4">
                <label for="nit_copropiedad" class="block text-gray-700 text-sm font-bold mb-2">Nit Copropiedad:</label>
                <input type="text" id="nit_copropiedad" name="nit_copropiedad" value="{{ $copropiedad->nit_copropiedad }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="nombre_copropiedad" class="block text-gray-700 text-sm font-bold mb-2">Nombre Copropiedad:</label>
                <input type="text" id="nombre_copropiedad" name="nombre_copropiedad" value="{{ $copropiedad->nombre_copropiedad }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="tipo_unidad" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Unidad:</label>
                <select name="tipo_unidad" id="tipo_unidad" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($tiposUnidad as $tipo_unidad)
                        <option value="{{ $tipo_unidad }}" {{ $copropiedad->tipo_unidad == $tipo_unidad ? 'selected' : '' }}>{{ $tipo_unidad }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="torre_bloque" class="block text-gray-700 text-sm font-bold mb-2">Torre/Bloque:</label>
                <input type="text" id="torre_bloque" name="torre_bloque" value="{{ $copropiedad->torre_bloque }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="n°" class="block text-gray-700 text-sm font-bold mb-2">N°:</label>
                <input type="text" id="n°" name="n°" value="{{ $copropiedad->n° }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="matricula_inmobiliaria" class="block text-gray-700 text-sm font-bold mb-2">Matrícula Inmobiliaria:</label>
                <input type="text" id="matricula_inmobiliaria" name="matricula_inmobiliaria" value="{{ $copropiedad->matricula_inmobiliaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="ficha_catastral" class="block text-gray-700 text-sm font-bold mb-2">Ficha Catastral:</label>
                <input type="text" id="ficha_catastral" name="ficha_catastral" value="{{ $copropiedad->ficha_catastral }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="area_mt_cuadrado" class="block text-gray-700 text-sm font-bold mb-2">Área Mt2:</label>
                <input type="text" id="area_mt_cuadrado" name="area_mt_cuadrado" value="{{ $copropiedad->area_mt_cuadrado }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="coeficiente_participacion" class="block text-gray-700 text-sm font-bold mb-2">Coeficiente de Participación %:</label>
                <input type="text" id="coeficiente_participacion" name="coeficiente_participacion" value="{{ $copropiedad->coeficiente_participacion }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="propietario1" class="block text-gray-700 text-sm font-bold mb-2">Propietario 1:</label>
                <input type="text" id="propietario1" name="propietario1" value="{{ $copropiedad->propietario1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="propietario2" class="block text-gray-700 text-sm font-bold mb-2">Propietario 2:</label>
                <input type="text" id="propietario2" name="propietario2" value="{{ $copropiedad->propietario2 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="inmobiliaria" class="block text-gray-700 text-sm font-bold mb-2">Inmobiliaria:</label>
                <input type="text" id="inmobiliaria" name="inmobiliaria" value="{{ $copropiedad->inmobiliaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="arrendatario1" class="block text-gray-700 text-sm font-bold mb-2">Arrendatario 1:</label>
                <input type="text" id="arrendatario1" name="arrendatario1" value="{{ $copropiedad->arrendatario1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="arrendatario2" class="block text-gray-700 text-sm font-bold mb-2">Arrendatario 2:</label>
                <input type="text" id="arrendatario2" name="arrendatario2" value="{{ $copropiedad->arrendatario2 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="placa_vehiculo" class="block text-gray-700 text-sm font-bold mb-2">Vehiculo Autorizado (Placa):</label>
                <input type="text" id="placa_vehiculo" name="placa_vehiculo" value="{{ $copropiedad->placa_vehiculo }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="profesion_oficio" class="block text-gray-700 text-sm font-bold mb-2">Profesión u Oficio:</label>
                <input type="text" id="profesion_oficio" name="profesion_oficio" value="{{ $copropiedad->profesion_oficio }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear cuotas de administración</h2>
            <div class="mb-4">
                <label for="fecha_inicio_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_cuotaOrdinaria" name="fecha_inicio_cuotaOrdinaria" value="{{ $copropiedad->fecha_inicio_cuotaOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Fecha Final):</label>
                <input type="date" id="fecha_final_cuotaOrdinaria" name="fecha_final_cuotaOrdinaria" value="{{ $copropiedad->fecha_final_cuotaOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Expensa Total):</label>
                <input type="text" id="expensa_total_cuotaOrdinaria" name="expensa_total_cuotaOrdinaria" value="{{ $copropiedad->expensa_total_cuotaOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Incremento Expensa Mes):</label>
                <input type="text" id="incremento_expensas_mes_cuotaOrdinaria" name="incremento_expensas_mes_cuotaOrdinaria" value="{{ $copropiedad->incremento_expensas_mes_cuotaOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_cuotaOrdinaria" name="modo_aplicacion_cuotaOrdinaria" value="{{ $copropiedad->modo_aplicacion_cuotaOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_ordinariaModular" name="fecha_inicio_ordinariaModular" value="{{ $copropiedad->fecha_inicio_ordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Fecha Final):</label>
                <input type="date" id="fecha_final_ordinariaModular" name="fecha_final_ordinariaModular" value="{{ $copropiedad->fecha_final_ordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Expensa Total):</label>
                <input type="text" id="expensa_total_ordinariaModular" name="expensa_total_ordinariaModular" value="{{ $copropiedad->expensa_total_ordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Incremento Expensas Mes):</label>
                <input type="text" id="incremento_expensas_mes_ordinariaModular" name="incremento_expensas_mes_ordinariaModular" value="{{ $copropiedad->incremento_expensas_mes_ordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_ordinariaModular" name="modo_aplicacion_ordinariaModular" value="{{ $copropiedad->modo_aplicacion_ordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_extraordinaria" name="fecha_inicio_extraordinaria" value="{{ $copropiedad->fecha_inicio_extraordinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Fecha Final):</label>
                <input type="date" id="fecha_final_extraordinaria" name="fecha_final_extraordinaria" value="{{ $copropiedad->fecha_final_extraordinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Expensa Total):</label>
                <input type="text" id="expensa_total_extraordinaria" name="expensa_total_extraordinaria" value="{{ $copropiedad->expensa_total_extraordinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Incremento Expensas Mes):</label>
                <input type="text" id="incremento_expensas_mes_extraordinaria" name="incremento_expensas_mes_extraordinaria" value="{{ $copropiedad->incremento_expensas_mes_extraordinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_extraordinaria" name="modo_aplicacion_extraordinaria" value="{{ $copropiedad->modo_aplicacion_extraordinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_extraordinariaModular" name="fecha_inicio_extraordinariaModular" value="{{ $copropiedad->fecha_inicio_extraordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Fecha Final):</label>
                <input type="date" id="fecha_final_extraordinariaModular" name="fecha_final_extraordinariaModular" value="{{ $copropiedad->fecha_final_extraordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Expensa Total):</label>
                <input type="text" id="expensa_total_extraordinariaModular" name="expensa_total_extraordinariaModular" value="{{ $copropiedad->expensa_total_extraordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Incremento Expensas Mes):</label>
                <input type="text" id="incremento_expensas_mes_extraordinariaModular" name="incremento_expensas_mes_extraordinariaModular" value="{{ $copropiedad->incremento_expensas_mes_extraordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_extraordinariaModular" name="modo_aplicacion_extraordinariaModular" value="{{ $copropiedad->modo_aplicacion_extraordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4 mb-4">Unidades</h2>
            <div class="mb-4">
                <label for="codigo_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Código Unidad 1:</label>
                <input type="number" id="codigo_unidad1" name="codigo_unidad1" value="{{ $copropiedad->codigo_unidad1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="nombre_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Nombre Unidad 1:</label>
                <input type="text" id="nombre_unidad1" name="nombre_unidad1" value="{{ $copropiedad->nombre_unidad1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="coeficiente_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Coeficiente % Unidad 1:</label>
                <input type="text" id="coeficiente_unidad1" name="coeficiente_unidad1" value="{{ $copropiedad->coeficiente_unidad1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="cuotaOrdinaria_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Unidad 1:</label>
                <input type="text" id="cuotaOrdinaria_unidad1" name="cuotaOrdinaria_unidad1" value="{{ $copropiedad->cuotaOrdinaria_unidad1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="ordinariaModular_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular Unidad 1:</label>
                <input type="text" id="ordinariaModular_unidad1" name="ordinariaModular_unidad1" value="{{ $copropiedad->ordinariaModular_unidad1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="extraordinaria_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota ExtraOrdinaria Unidad 1:</label>
                <input type="text" id="extraordinaria_unidad1" name="extraordinaria_unidad1" value="{{ $copropiedad->extraordinaria_unidad1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="extraordinariaModular_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota ExtraOrdinaria Modular Unidad 1:</label>
                <input type="text" id="extraordinariaModular_unidad1" name="extraordinariaModular_unidad1" value="{{ $copropiedad->extraordinariaModular_unidad1 }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>


        </div> <!-- Columna izquierda -->

            <div class="w-3/4"> <!-- Columna derecha -->
                

                <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear descuento pronto pago</h2>
                <div class="mb-4">
                    <label for="fechaInicio_descuentoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Descuento Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_descuentoOrdinaria" name="fechaInicio_descuentoOrdinaria" value="{{ $copropiedad->fechaInicio_descuentoOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fecha_final_descuentoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Descuento Fecha Final):</label>
                    <input type="date" id="fecha_final_descuentoOrdinaria" name="fecha_final_descuentoOrdinaria" value="{{ $copropiedad->fecha_final_descuentoOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="descuento_porcentaje_ordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Descuento %):</label>
                    <input type="text" id="descuento_porcentaje_ordinaria" name="descuento_porcentaje_ordinaria" value="{{ $copropiedad->descuento_porcentaje_ordinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valor_fijo_ordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Valor Fijo):</label>
                    <input type="text" id="valor_fijo_ordinaria" name="valor_fijo_ordinaria" value="{{ $copropiedad->valor_fijo_ordinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaInicio_descuentoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Descuento Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_descuentoOrdinariaModular" name="fechaInicio_descuentoOrdinariaModular" value="{{ $copropiedad->fechaInicio_descuentoOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fecha_final_descuentoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Descuento Fecha Final):</label>
                    <input type="date" id="fecha_final_descuentoOrdinariaModular" name="fecha_final_descuentoOrdinariaModular" value="{{ $copropiedad->fecha_final_descuentoOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="descuento_porcentaje_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Descuento %):</label>
                    <input type="text" id="descuento_porcentaje_ordinariaModular" name="descuento_porcentaje_ordinariaModular" value="{{ $copropiedad->descuento_porcentaje_ordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valor_fijo_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Valor Fijo):</label>
                    <input type="text" id="valor_fijo_ordinariaModular" name="valor_fijo_ordinariaModular" value="{{ $copropiedad->valor_fijo_ordinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear Retroactivos</h2>
                <div class="mb-4">
                    <label for="fechaInicio_retroactivoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria (Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_retroactivoOrdinaria" name="fechaInicio_retroactivoOrdinaria" value="{{ $copropiedad->fechaInicio_retroactivoOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaFinal_retroactivoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria (Fecha Final):</label>
                    <input type="date" id="fechaFinal_retroactivoOrdinaria" name="fechaFinal_retroactivoOrdinaria" value="{{ $copropiedad->fechaFinal_retroactivoOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="nombreUnidad1_retroactivoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria (Nombre Unidad 1):</label>
                    <input type="text" id="nombreUnidad1_retroactivoOrdinaria" name="nombreUnidad1_retroactivoOrdinaria" value="{{ $copropiedad->nombreUnidad1_retroactivoOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorUnidad1_retroactivoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria (Valor Unidad 1):</label>
                    <input type="text" id="valorUnidad1_retroactivoOrdinaria" name="valorUnidad1_retroactivoOrdinaria" value="{{ $copropiedad->valorUnidad1_retroactivoOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaInicio_retroactivoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria Modular (Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_retroactivoOrdinariaModular" name="fechaInicio_retroactivoOrdinariaModular" value="{{ $copropiedad->fechaInicio_retroactivoOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaFinal_retroactivoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria Modular (Fecha Final):</label>
                    <input type="date" id="fechaFinal_retroactivoOrdinariaModular" name="fechaFinal_retroactivoOrdinariaModular" value="{{ $copropiedad->fechaFinal_retroactivoOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="nombreUnidad1_retroactivoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria Modular (Nombre Unidad 1):</label>
                    <input type="text" id="nombreUnidad1_retroactivoOrdinariaModular" name="nombreUnidad1_retroactivoOrdinariaModular" value="{{ $copropiedad->nombreUnidad1_retroactivoOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorUnidad1_retroactivoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Retroactivo Ordinaria Modular (Valor Unidad 1):</label>
                    <input type="text" id="valorUnidad1_retroactivoOrdinariaModular" name="valorUnidad1_retroactivoOrdinariaModular" value="{{ $copropiedad->valorUnidad1_retroactivoOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear Consejeros</h2>
                <div class="mb-4">
                    <label for="fechaInicio_consejeroOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria (Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_consejeroOrdinaria" name="fechaInicio_consejeroOrdinaria" value="{{ $copropiedad->fechaInicio_consejeroOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaFinal_consejeroOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria (Fecha Final):</label>
                    <input type="date" id="fechaFinal_consejeroOrdinaria" name="fechaFinal_consejeroOrdinaria" value="{{ $copropiedad->fechaFinal_consejeroOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="descuentoOrdinaria_consejero" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria (Descuento %):</label>
                    <input type="text" id="descuentoOrdinaria_consejero" name="descuentoOrdinaria_consejero" value="{{ $copropiedad->descuentoOrdinaria_consejero }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorFijo_consejeroOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria (Valor Fijo):</label>
                    <input type="text" id="valorFijo_consejeroOrdinaria" name="valorFijo_consejeroOrdinaria" value="{{ $copropiedad->valorFijo_consejeroOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="nombreUnidad1_consejeroOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria (Nombre Unidad 1):</label>
                    <input type="text" id="nombreUnidad1_consejeroOrdinaria" name="nombreUnidad1_consejeroOrdinaria" value="{{ $copropiedad->nombreUnidad1_consejeroOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="propietarioUnidad1_consejeroOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria (Propietario Unidad 1):</label>
                    <input type="text" id="propietarioUnidad1_consejeroOrdinaria" name="propietarioUnidad1_consejeroOrdinaria" value="{{ $copropiedad->propietarioUnidad1_consejeroOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorUnidad1_consejeroOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria (Valor Unidad 1):</label>
                    <input type="text" id="valorUnidad1_consejeroOrdinaria" name="valorUnidad1_consejeroOrdinaria" value="{{ $copropiedad->valorUnidad1_consejeroOrdinaria }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaInicio_consejeroOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria Modular (Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_consejeroOrdinariaModular" name="fechaInicio_consejeroOrdinariaModular" value="{{ $copropiedad->fechaInicio_consejeroOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaFinal_consejeroOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria Modular (Fecha Final):</label>
                    <input type="date" id="fechaFinal_consejeroOrdinariaModular" name="fechaFinal_consejeroOrdinariaModular" value="{{ $copropiedad->fechaFinal_consejeroOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="descuentoOrdinariaModular_consejero" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria Modular (Descuento %):</label>
                    <input type="text" id="descuentoOrdinariaModular_consejero" name="descuentoOrdinariaModular_consejero" value="{{ $copropiedad->descuentoOrdinariaModular_consejero }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorFijo_consejeroOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria Modular (Valor Fijo):</label>
                    <input type="text" id="valorFijo_consejeroOrdinariaModular" name="valorFijo_consejeroOrdinariaModular" value="{{ $copropiedad->valorFijo_consejeroOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorUnidad1_consejeroOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Consejero Ordinaria Modular (Valor Unidad 1):</label>
                    <input type="text" id="valorUnidad1_consejeroOrdinariaModular" name="valorUnidad1_consejeroOrdinariaModular" value="{{ $copropiedad->valorUnidad1_consejeroOrdinariaModular }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear Conceptos de Facturación</h2>
                <div class="mb-4">
                    <label for="fechaInicio_conceptoFacturación" class="block text-gray-700 text-sm font-bold mb-2">Concepto Facturación (Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_conceptoFacturación" name="fechaInicio_conceptoFacturación" value="{{ $copropiedad->fechaInicio_conceptoFacturación }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaFinal_conceptoFacturacion" class="block text-gray-700 text-sm font-bold mb-2">Concepto Facturación (Fecha Final):</label>
                    <input type="date" id="fechaFinal_conceptoFacturacion" name="fechaFinal_conceptoFacturacion" value="{{ $copropiedad->fechaFinal_conceptoFacturacion }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="codigo_conceptoFacturacion" class="block text-gray-700 text-sm font-bold mb-2">Concepto Facturación (Código):</label>
                    <input type="text" id="codigo_conceptoFacturacion" name="codigo_conceptoFacturacion" value="{{ $copropiedad->codigo_conceptoFacturacion }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="nombre_conceptoFacturacion" class="block text-gray-700 text-sm font-bold mb-2">Concepto Facturación (Nombre):</label>
                    <select name="nombre_conceptoFacturacion" id="nombre_conceptoFacturacion" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($nombre_conceptosFacturacion as $nombre_conceptoFacturacion)
                            <option value="{{ $nombre_conceptoFacturacion }}" {{ $copropiedad->nombre_conceptoFacturacion == $nombre_conceptoFacturacion ? 'selected' : '' }}>{{ $nombre_conceptoFacturacion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="valorFijo_conceptoFacturacion" class="block text-gray-700 text-sm font-bold mb-2">Concepto Facturación (Valor Fijo):</label>
                    <input type="text" id="valorFijo_conceptoFacturacion" name="valorFijo_conceptoFacturacion" value="{{ $copropiedad->valorFijo_conceptoFacturacion }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorImpuesto_IVAGeneradoPorcentaje" class="block text-gray-700 text-sm font-bold mb-2">Valor Impuesto (IVA Generado %):</label>
                    <input type="text" id="valorImpuesto_IVAGeneradoPorcentaje" name="valorImpuesto_IVAGeneradoPorcentaje" value="{{ $copropiedad->valorImpuesto_IVAGeneradoPorcentaje }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valorFijoImpuesto_IVAGenerado" class="block text-gray-700 text-sm font-bold mb-2">Valor Fijo Impuesto (IVA Generado):</label>
                    <input type="text" id="valorFijoImpuesto_IVAGenerado" name="valorFijoImpuesto_IVAGenerado" value="{{ $copropiedad->valorFijoImpuesto_IVAGenerado }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="imputacionContable_Db" class="block text-gray-700 text-sm font-bold mb-2">Imputación Contable (Db):</label>
                    <input type="text" id="imputacionContable_Db" name="imputacionContable_Db" value="{{ $copropiedad->imputacionContable_Db }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="imputacionContable_Cr" class="block text-gray-700 text-sm font-bold mb-2">Imputación Contable (Cr):</label>
                    <input type="text" id="imputacionContable_Cr" name="imputacionContable_Cr" value="{{ $copropiedad->imputacionContable_Cr }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear Intereses de mora</h2>
                <div class="mb-4">
                    <label for="aplicarA_conceptoFacturacion" class="block text-gray-700 text-sm font-bold mb-2">Concepto Facturación (Aplicar a):</label>
                    <select name="aplicarA_conceptoFacturacion" id="aplicarA_conceptoFacturacion" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($aplicarA_conceptosFacturacion as $aplicarA_conceptoFacturacion)
                            <option value="{{ $aplicarA_conceptoFacturacion }}" {{ $copropiedad->aplicarA_conceptoFacturacion == $aplicarA_conceptoFacturacion ? 'selected' : '' }}>{{ $aplicarA_conceptoFacturacion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tasaMensual" class="block text-gray-700 text-sm font-bold mb-2">Tasa Mensual %:</label>
                    <input type="text" id="tasaMensual" name="tasaMensual" value="{{ $copropiedad->tasaMensual }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logotipo:</label>
                    @if($copropiedad->logo)
                        <div class="mb-4">
                        <p class="text-sm text-gray-600">Archivo actual: {{ $copropiedad->logo }}</p>
                        </div>
                    @endif
                    <input type="file" id="logo" name="logo" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
            
                <!-- Botón para actualizar la copropiedad -->
                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar Copropiedad</button>
                </div>

            </div> <!-- Columna derecha -->
        </form>

</div>
<!-- Fin formulario editar copropiedad -->


<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->

</body>
</html>