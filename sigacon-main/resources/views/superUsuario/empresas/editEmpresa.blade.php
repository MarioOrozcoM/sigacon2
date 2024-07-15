<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Editar Empresa Info</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<h2 class="text-xl font-bold uppercase text-center mt-4">Editar Empresa</h2>


<!-- Inicio Formulario editar Empresa -->
<div class="container mx-auto px-4 mt-8 mb-6 mr-4 grid grid-cols-2 gap-4">
    <div class="w-3/4"> <!-- Columna izquierda -->
        <form action="{{ route('empresas.update', $empresa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2 class="text-xl font-semibold text-center mt-4">Datos Empresa</h2>
        <div class="mb-4">
                <label for="codigo_empresa" class="block text-gray-700 text-sm font-bold mb-2">Código Empresa:</label>
                <input type="text" id="codigo_empresa" name="codigo_empresa" value="{{ $empresa->codigo_empresa }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="tipo_empresa" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Empresa:</label>
                <select name="tipo_empresa" id="tipo_empresa" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($tiposEmpresa as $tipo_empresa)
                    <option value="{{ $tipo_empresa }}" {{ $empresa->tipo_empresa == $tipo_empresa ? 'selected' : '' }}>{{ $tipo_empresa }}</option>
                    @endforeach
                </select>
        </div>
        <div class="mb-4">
            <label for="numero_identificacion" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
            <input type="number" id="numero_identificacion" name="numero_identificacion" value="{{ $empresa->numero_identificacion }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" readonly>
        </div>

        <div class="mb-4">
                <label for="persona_juridica" class="block text-gray-700 text-sm font-bold mb-2">Persona Jurídica:</label>
                <select name="persona_juridica" id="persona_juridica" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    <option value="1" {{ $empresa->persona_juridica == 1 ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ $empresa->persona_juridica == 0 ? 'selected' : '' }}>No</option>
                </select>
        </div>
        <div class="mb-4">
                <label for="primer_nombre" class="block text-gray-700 text-sm font-bold mb-2">Primer Nombre:</label>
                <input type="text" id="primer_nombre" name="primer_nombre" value="{{ $empresa->primer_nombre }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="segundo_nombre" class="block text-gray-700 text-sm font-bold mb-2">Segundo Nombre:</label>
                <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ $empresa->segundo_nombre }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="primer_apellido" class="block text-gray-700 text-sm font-bold mb-2">Primer Apellido:</label>
                <input type="text" id="primer_apellido" name="primer_apellido" value="{{ $empresa->primer_apellido }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="segundo_apellido" class="block text-gray-700 text-sm font-bold mb-2">Segundo Apellido:</label>
                <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ $empresa->segundo_apellido }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="razon_social" class="block text-gray-700 text-sm font-bold mb-2">Razón Social:</label>
                <input type="text" id="razon_social" name="razon_social" value="{{ $empresa->razon_social }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="nombre_comercial" class="block text-gray-700 text-sm font-bold mb-2">Nombre Comercial:</label>
                <input type="text" id="nombre_comercial" name="nombre_comercial" value="{{ $empresa->nombre_comercial }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <h2 class="text-xl font-semibold text-center mt-4">Representante Legal</h2>
            <div class="mb-4">
                <label for="numero_identificacion_repre" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_repre" name="numero_identificacion_repre" value="{{ $empresa->numero_identificacion_repre }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="fecha_inicio_repre" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_repre" name="fecha_inicio_repre" value="{{ $empresa->fecha_inicio_repre }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="numero_acta_repre" class="block text-gray-700 text-sm font-bold mb-2">Número Acta:</label>
                <input type="text" id="numero_acta_repre" name="numero_acta_repre" value="{{ $empresa->numero_acta_repre }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <h2 class="text-xl font-semibold text-center mt-4">Representante Legal Suplente</h2>
        <div class="mb-4">
                <label for="numero_identificacion_suplente" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_suplente" name="numero_identificacion_suplente" value="{{ $empresa->numero_identificacion_suplente }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="fecha_inicio_suplente" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_suplente" name="fecha_inicio_suplente" value="{{ $empresa->fecha_inicio_suplente }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="numero_acta_suplente" class="block text-gray-700 text-sm font-bold mb-2">Número Acta:</label>
                <input type="text" id="numero_acta_suplente" name="numero_acta_suplente" value="{{ $empresa->numero_acta_suplente }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <h2 class="text-xl font-semibold text-center mt-4">Contador Público</h2>
        <div class="mb-4">
                <label for="numero_identificacion_contador" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_contador" name="numero_identificacion_contador" value="{{ $empresa->numero_identificacion_contador }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="fecha_inicio_contador" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_contador" name="fecha_inicio_contador" value="{{ $empresa->fecha_inicio_contador }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="tarjeta_profesional_contador" class="block text-gray-700 text-sm font-bold mb-2">Tarjeta Profesional:</label>
                <input type="text" id="tarjeta_profesional_contador" name="tarjeta_profesional_contador" value="{{ $empresa->tarjeta_profesional_contador }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
    </div> <!-- Fin Columna izquierda -->
    <div class="w-3/4"> <!-- Inicio Columna derecha -->
        <h2 class="text-xl font-semibold text-center mt-4">Revisor Fiscal</h2>
        <div class="mb-4">
                <label for="numero_identificacion_revisor" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_revisor" name="numero_identificacion_revisor" value="{{ $empresa->numero_identificacion_revisor }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="fecha_inicio_revisor" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_revisor" name="fecha_inicio_revisor" value="{{ $empresa->fecha_inicio_revisor }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="tarjeta_profesional_revisor" class="block text-gray-700 text-sm font-bold mb-2">Tarjeta Profesional:</label>
                <input type="text" id="tarjeta_profesional_revisor" name="tarjeta_profesional_revisor" value="{{ $empresa->tarjeta_profesional_revisor }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="numero_acta_revisor" class="block text-gray-700 text-sm font-bold mb-2">Número de Acta:</label>
                <input type="text" id="numero_acta_revisor" name="numero_acta_revisor" value="{{ $empresa->numero_acta_revisor }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <h2 class="text-xl font-semibold text-center mt-4">Socios/Asociados/Accionistas</h2>
        <div class="mb-4">
                <label for="numero_identificacion_socio" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_socio" name="numero_identificacion_socio" value="{{ $empresa->numero_identificacion_socio }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="fecha_registro_socio" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Registro:</label>
                <input type="date" id="fecha_registro_socio" name="fecha_registro_socio" value="{{ $empresa->fecha_registro_socio }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="numero_acciones" class="block text-gray-700 text-sm font-bold mb-2">Número de Acciones ó Porcentaje:</label>
                <input type="text" id="numero_acciones" name="numero_acciones" value="{{ $empresa->numero_acciones }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="numero_titulo" class="block text-gray-700 text-sm font-bold mb-2">Número de Título:</label>
                <input type="text" id="numero_titulo" name="numero_titulo" value="{{ $empresa->numero_titulo }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <h2 class="text-xl font-semibold text-center mt-4">Resolución de Facturación</h2>
        <div class="mb-4">
                <label for="numero_resolucion" class="block text-gray-700 text-sm font-bold mb-2">Número Resolución:</label>
                <input type="text" id="numero_resolucion" name="numero_resolucion" value="{{ $empresa->numero_resolucion }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="fecha_resolucion" class="block text-gray-700 text-sm font-bold mb-2">Fecha Resolución:</label>
                <input type="date" id="fecha_resolucion" name="fecha_resolucion" value="{{ $empresa->fecha_resolucion }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
                <label for="rangos_numeracion" class="block text-gray-700 text-sm font-bold mb-2">Rangos de Numeración:</label>
                <input type="text" id="rangos_numeracion" name="rangos_numeracion" value="{{ $empresa->rangos_numeracion }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="observaciones" class="block text-gray-700 text-sm font-bold mb-2">Observaciones:</label>
            <textarea id="observaciones" name="observaciones" class="border border-gray-400 rounded-md py-2 px-3 w-full">{{ $empresa->observaciones }}</textarea>
        </div>

        <div>

        </div>
        <div class="mb-4">
                <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logotipo:</label>
                @if($empresa->logo)
                        <div class="mb-4">
                        <p class="text-sm text-gray-600">Archivo actual: {{ $empresa->logo }}</p>
                        </div>
                @endif
                <input type="file" id="logo" name="logo" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>


        <div class="mb-4">
                <label for="tamano_empresa" class="block text-gray-700 text-sm font-bold mb-2">Tamaño de Empresa:</label>
                <select name="tamano_empresa" id="tamano_empresa" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($tamanosEmpresa as $tamano_empresa)
                    <option value="{{ $tamano_empresa }}" {{ $empresa->tamano_empresa == $tamano_empresa ? 'selected' : '' }}>{{ $tamano_empresa }}</option>
                    @endforeach
                </select>
        </div>
        <!-- Botón para actualizar Empresa -->
        <div class="mt-8">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar Empresa</button>
        </div>

        </form>
                <!-- Enlace para descargar el archivo Excel -->
                <div class=" mt-8">
                        <a href="{{ route('download.excel.empresa', ['empresaId' => $empresa->id]) }}" class="bg-green-300 hover:bg-green-400 text-black font-bold py-2 px-4 rounded">Descargar Excel</a>
                </div>
        </div> <!-- Fin Columna derecha -->

</div>
<!-- Fin Formulario editar Empresa -->


<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->
    
</body>
</html>