<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Copropiedad</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<h2 class="text-xl font-semibold text-center mt-4">Agregar Nueva Copropiedad</h2>

<!-- Inicio Formulario crear copropiedad -->
<div class="container mx-auto px-4 mt-8 mb-6 mr-4 grid grid-cols-2 gap-4">
    <div class="w-3/4"> <!-- Columna izquierda -->
        <form action="{{ route('copropiedades.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-semibold text-center mt-4 mb-4">Datos Copropiedad</h2>
            
            <div class="mb-4">
                <label for="nit_copropiedad" class="block text-gray-700 text-sm font-bold mb-2">Nit Copropiedad:</label>
                <input type="text" id="nit_copropiedad" name="nit_copropiedad" value="{{ old('nit_copropiedad') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="nombre_copropiedad" class="block text-gray-700 text-sm font-bold mb-2">Nombre Copropiedad:</label>
                <input type="text" id="nombre_copropiedad" name="nombre_copropiedad" value="{{ old('nombre_copropiedad') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="tipo_unidad" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Unidad:</label>
                <select name="tipo_unidad" id="tipo_unidad" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($tiposUnidad as $tipo_unidad)
                        <option value="{{ $tipo_unidad }}">{{ $tipo_unidad }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="torre_bloque" class="block text-gray-700 text-sm font-bold mb-2">Torre/Bloque:</label>
                <input type="text" id="torre_bloque" name="torre_bloque" value="{{ old('torre_bloque') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="n°" class="block text-gray-700 text-sm font-bold mb-2">N°:</label>
                <input type="text" id="n°" name="n°" value="{{ old('n°') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="matricula_inmobiliaria" class="block text-gray-700 text-sm font-bold mb-2">Matrícula Inmobiliaria:</label>
                <input type="text" id="matricula_inmobiliaria" name="matricula_inmobiliaria" value="{{ old('matricula_inmobiliaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="ficha_catastral" class="block text-gray-700 text-sm font-bold mb-2">Ficha Catastral:</label>
                <input type="text" id="ficha_catastral" name="ficha_catastral" value="{{ old('ficha_catastral') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="area_mt_cuadrado" class="block text-gray-700 text-sm font-bold mb-2">Área Mt2:</label>
                <input type="text" id="area_mt_cuadrado" name="area_mt_cuadrado" value="{{ old('area_mt_cuadrado') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="coeficiente_participacion" class="block text-gray-700 text-sm font-bold mb-2">Coeficiente de Participación %:</label>
                <input type="text" id="coeficiente_participacion" name="coeficiente_participacion" value="{{ old('coeficiente_participacion') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="propietario1" class="block text-gray-700 text-sm font-bold mb-2">Propietario 1:</label>
                <input type="text" id="propietario1" name="propietario1" value="{{ old('propietario1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="propietario2" class="block text-gray-700 text-sm font-bold mb-2">Propietario 2:</label>
                <input type="text" id="propietario2" name="propietario2" value="{{ old('propietario2') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="inmobiliaria" class="block text-gray-700 text-sm font-bold mb-2">Inmobiliaria:</label>
                <input type="text" id="inmobiliaria" name="inmobiliaria" value="{{ old('inmobiliaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="arrendatario1" class="block text-gray-700 text-sm font-bold mb-2">Arrendatario 1:</label>
                <input type="text" id="arrendatario1" name="arrendatario1" value="{{ old('arrendatario1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="arrendatario2" class="block text-gray-700 text-sm font-bold mb-2">Arrendatario 2:</label>
                <input type="text" id="arrendatario2" name="arrendatario2" value="{{ old('arrendatario2') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="placa_vehiculo" class="block text-gray-700 text-sm font-bold mb-2">Vehiculo Autorizado (Placa):</label>
                <input type="text" id="placa_vehiculo" name="placa_vehiculo" value="{{ old('placa_vehiculo') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="profesion_oficio" class="block text-gray-700 text-sm font-bold mb-2">Profesión u Oficio:</label>
                <input type="text" id="profesion_oficio" name="profesion_oficio" value="{{ old('profesion_oficio') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear cuotas de administración</h2>
            <div class="mb-4">
                <label for="fecha_inicio_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_cuotaOrdinaria" name="fecha_inicio_cuotaOrdinaria" value="{{ old('fecha_inicio_cuotaOrdinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Fecha Final):</label>
                <input type="date" id="fecha_final_cuotaOrdinaria" name="fecha_final_cuotaOrdinaria" value="{{ old('fecha_final_cuotaOrdinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Expensa Total):</label>
                <input type="text" id="expensa_total_cuotaOrdinaria" name="expensa_total_cuotaOrdinaria" value="{{ old('expensa_total_cuotaOrdinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Incremento Expensa Mes):</label>
                <input type="text" id="incremento_expensas_mes_cuotaOrdinaria" name="incremento_expensas_mes_cuotaOrdinaria" value="{{ old('incremento_expensas_mes_cuotaOrdinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_cuotaOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_cuotaOrdinaria" name="modo_aplicacion_cuotaOrdinaria" value="{{ old('modo_aplicacion_cuotaOrdinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_ordinariaModular" name="fecha_inicio_ordinariaModular" value="{{ old('fecha_inicio_ordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Fecha Final):</label>
                <input type="date" id="fecha_final_ordinariaModular" name="fecha_final_ordinariaModular" value="{{ old('fecha_final_ordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Expensa Total):</label>
                <input type="text" id="expensa_total_ordinariaModular" name="expensa_total_ordinariaModular" value="{{ old('expensa_total_ordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Incremento Expensas Mes):</label>
                <input type="text" id="incremento_expensas_mes_ordinariaModular" name="incremento_expensas_mes_ordinariaModular" value="{{ old('incremento_expensas_mes_ordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_ordinariaModular" name="modo_aplicacion_ordinariaModular" value="{{ old('modo_aplicacion_ordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_extraordinaria" name="fecha_inicio_extraordinaria" value="{{ old('fecha_inicio_extraordinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Fecha Final):</label>
                <input type="date" id="fecha_final_extraordinaria" name="fecha_final_extraordinaria" value="{{ old('fecha_final_extraordinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Expensa Total):</label>
                <input type="text" id="expensa_total_extraordinaria" name="expensa_total_extraordinaria" value="{{ old('expensa_total_extraordinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Incremento Expensas Mes):</label>
                <input type="text" id="incremento_expensas_mes_extraordinaria" name="incremento_expensas_mes_extraordinaria" value="{{ old('incremento_expensas_mes_extraordinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_extraordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_extraordinaria" name="modo_aplicacion_extraordinaria" value="{{ old('modo_aplicacion_extraordinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Fecha Inicio):</label>
                <input type="date" id="fecha_inicio_extraordinariaModular" name="fecha_inicio_extraordinariaModular" value="{{ old('fecha_inicio_extraordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_final_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Fecha Final):</label>
                <input type="date" id="fecha_final_extraordinariaModular" name="fecha_final_extraordinariaModular" value="{{ old('fecha_final_extraordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="expensa_total_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Expensa Total):</label>
                <input type="text" id="expensa_total_extraordinariaModular" name="expensa_total_extraordinariaModular" value="{{ old('expensa_total_extraordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="incremento_expensas_mes_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Incremento Expensas Mes):</label>
                <input type="text" id="incremento_expensas_mes_extraordinariaModular" name="incremento_expensas_mes_extraordinariaModular" value="{{ old('incremento_expensas_mes_extraordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="modo_aplicacion_extraordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Extraordinaria Modular (Modo Aplicación):</label>
                <input type="text" id="modo_aplicacion_extraordinariaModular" name="modo_aplicacion_extraordinariaModular" value="{{ old('modo_aplicacion_extraordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4 mb-4">Unidades</h2>
            <div class="mb-4">
                <label for="codigo_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Código Unidad 1:</label>
                <input type="number" id="codigo_unidad1" name="codigo_unidad1" value="{{ old('codigo_unidad1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="nombre_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Nombre Unidad 1:</label>
                <input type="text" id="nombre_unidad1" name="nombre_unidad1" value="{{ old('nombre_unidad1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="coeficiente_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Coeficiente % Unidad 1:</label>
                <input type="text" id="coeficiente_unidad1" name="coeficiente_unidad1" value="{{ old('coeficiente_unidad1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="cuotaOrdinaria_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Unidad 1:</label>
                <input type="text" id="cuotaOrdinaria_unidad1" name="cuotaOrdinaria_unidad1" value="{{ old('cuotaOrdinaria_unidad1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="ordinariaModular_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular Unidad 1:</label>
                <input type="text" id="ordinariaModular_unidad1" name="ordinariaModular_unidad1" value="{{ old('ordinariaModular_unidad1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="extraordinaria_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota ExtraOrdinaria Unidad 1:</label>
                <input type="text" id="extraordinaria_unidad1" name="extraordinaria_unidad1" value="{{ old('extraordinaria_unidad1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="extraordinariaModular_unidad1" class="block text-gray-700 text-sm font-bold mb-2">Cuota ExtraOrdinaria Modular Unidad 1:</label>
                <input type="text" id="extraordinariaModular_unidad1" name="extraordinariaModular_unidad1" value="{{ old('extraordinariaModular_unidad1') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>


        </div> <!-- Columna izquierda -->

            <div class="w-3/4"> <!-- Columna derecha -->
                

                <h2 class="text-xl font-semibold text-center mt-4 mb-4">Crear descuento pronto pago</h2>
                <div class="mb-4">
                    <label for="fechaInicio_descuentoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Descuento Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_descuentoOrdinaria" name="fechaInicio_descuentoOrdinaria" value="{{ old('fechaInicio_descuentoOrdinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fecha_final_descuentoOrdinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Descuento Fecha Final):</label>
                    <input type="date" id="fecha_final_descuentoOrdinaria" name="fecha_final_descuentoOrdinaria" value="{{ old('fecha_final_descuentoOrdinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="descuento_porcentaje_ordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Descuento %):</label>
                    <input type="text" id="descuento_porcentaje_ordinaria" name="descuento_porcentaje_ordinaria" value="{{ old('descuento_porcentaje_ordinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valor_fijo_ordinaria" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria (Valor Fijo):</label>
                    <input type="text" id="valor_fijo_ordinaria" name="valor_fijo_ordinaria" value="{{ old('valor_fijo_ordinaria') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fechaInicio_descuentoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Descuento Fecha Inicio):</label>
                    <input type="date" id="fechaInicio_descuentoOrdinariaModular" name="fechaInicio_descuentoOrdinariaModular" value="{{ old('fechaInicio_descuentoOrdinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="fecha_final_descuentoOrdinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Descuento Fecha Final):</label>
                    <input type="date" id="fecha_final_descuentoOrdinariaModular" name="fecha_final_descuentoOrdinariaModular" value="{{ old('fecha_final_descuentoOrdinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="descuento_porcentaje_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Descuento %):</label>
                    <input type="text" id="descuento_porcentaje_ordinariaModular" name="descuento_porcentaje_ordinariaModular" value="{{ old('descuento_porcentaje_ordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
                <div class="mb-4">
                    <label for="valor_fijo_ordinariaModular" class="block text-gray-700 text-sm font-bold mb-2">Cuota Ordinaria Modular (Valor Fijo):</label>
                    <input type="text" id="valor_fijo_ordinariaModular" name="valor_fijo_ordinariaModular" value="{{ old('valor_fijo_ordinariaModular') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>
            
                <!-- Botón para crear la copropiedad -->
                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Copropiedad</button>
                </div>

            </div> <!-- Columna derecha -->
        </form>

</div>
<!-- Fin formulario crear copropiedad -->



<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->
    
</body>
</html>