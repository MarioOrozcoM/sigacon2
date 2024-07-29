<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empresa</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<h2 class="text-xl font-semibold text-center mt-4">Agregar Nueva Empresa</h2>

<!-- Inicio Formulario crear empresa -->
<div class="container mx-auto px-4 mt-8 mb-6 mr-4 grid grid-cols-2 gap-4">
    <div class="w-3/4"> <!-- Columna izquierda -->
        <form action="{{ route('empresas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-semibold text-center mt-4">Datos Empresa</h2>
            <div class="mb-4">
                <label for="codigo_empresa" class="block text-gray-700 text-sm font-bold mb-2">Código Empresa:</label>
                <input type="text" id="codigo_empresa" name="codigo_empresa" value="{{ old('codigo_empresa') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="tipo_empresa" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Empresa:</label>
                <select name="tipo_empresa" id="tipo_empresa" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($tiposEmpresa as $tipo_empresa)
                        <option value="{{ $tipo_empresa }}">{{ $tipo_empresa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="numero_identificacion" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion" name="numero_identificacion" value="{{ old('numero_identificacion') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="persona_juridica" class="block text-gray-700 text-sm font-bold mb-2">Persona Jurídica:</label>
                <select name="persona_juridica" id="persona_juridica" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div id="fields_to_disable"> <!-- Inicio div para ocultar campos -->
            <div class="mb-4">
                <label for="primer_nombre" class="block text-gray-700 text-sm font-bold mb-2">Primer Nombre:</label>
                <input type="text" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="segundo_nombre" class="block text-gray-700 text-sm font-bold mb-2">Segundo Nombre:</label>
                <input type="text" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="primer_apellido" class="block text-gray-700 text-sm font-bold mb-2">Primer Apellido:</label>
                <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="segundo_apellido" class="block text-gray-700 text-sm font-bold mb-2">Segundo Apellido:</label>
                <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            </div> <!-- Fin div para ocultar campos -->

            <div class="mb-4">
                <label for="razon_social" class="block text-gray-700 text-sm font-bold mb-2">Razón Social:</label>
                <input type="text" id="razon_social" name="razon_social" value="{{ old('razon_social') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="nombre_comercial" class="block text-gray-700 text-sm font-bold mb-2">Nombre Comercial:</label>
                <input type="text" id="nombre_comercial" name="nombre_comercial" value="{{ old('nombre_comercial') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4">Representante Legal</h2>
            <div class="mb-4">
                <label for="numero_identificacion_repre" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_repre" name="numero_identificacion_repre" value="{{ old('numero_identificacion_repre') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_repre" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_repre" name="fecha_inicio_repre" value="{{ old('fecha_inicio_repre') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="numero_acta_repre" class="block text-gray-700 text-sm font-bold mb-2">Número Acta:</label>
                <input type="text" id="numero_acta_repre" name="numero_acta_repre" value="{{ old('numero_acta_repre') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4">Representante Legal Suplente</h2>
            <div class="mb-4">
                <label for="numero_identificacion_suplente" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_suplente" name="numero_identificacion_suplente" value="{{ old('numero_identificacion_suplente') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_suplente" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_suplente" name="fecha_inicio_suplente" value="{{ old('fecha_inicio_suplente') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="numero_acta_suplente" class="block text-gray-700 text-sm font-bold mb-2">Número Acta:</label>
                <input type="text" id="numero_acta_suplente" name="numero_acta_suplente" value="{{ old('numero_acta_suplente') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4">Contador Público</h2>
            <div class="mb-4">
                <label for="numero_identificacion_contador" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_contador" name="numero_identificacion_contador" value="{{ old('numero_identificacion_contador') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_contador" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_contador" name="fecha_inicio_contador" value="{{ old('fecha_inicio_contador') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="tarjeta_profesional_contador" class="block text-gray-700 text-sm font-bold mb-2">Tarjeta Profesional:</label>
                <input type="text" id="tarjeta_profesional_contador" name="tarjeta_profesional_contador" value="{{ old('tarjeta_profesional_contador') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>

    </div> <!-- Columna izquierda -->

            <div class="w-3/4"> <!-- Columna derecha -->

            <h2 class="text-xl font-semibold text-center mt-4">Revisor Fiscal</h2>
            <div class="mb-4">
                <label for="numero_identificacion_revisor" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_revisor" name="numero_identificacion_revisor" value="{{ old('numero_identificacion_revisor') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio_revisor" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio_revisor" name="fecha_inicio_revisor" value="{{ old('fecha_inicio_revisor') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="tarjeta_profesional_revisor" class="block text-gray-700 text-sm font-bold mb-2">Tarjeta Profesional:</label>
                <input type="text" id="tarjeta_profesional_revisor" name="tarjeta_profesional_revisor" value="{{ old('tarjeta_profesional_revisor') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="numero_acta_revisor" class="block text-gray-700 text-sm font-bold mb-2">Número de Acta:</label>
                <input type="text" id="numero_acta_revisor" name="numero_acta_revisor" value="{{ old('numero_acta_revisor') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>

            <h2 class="text-xl font-semibold text-center mt-4">Socios/Asociados/Accionistas</h2>
            <div class="mb-4">
                <label for="numero_identificacion_socio" class="block text-gray-700 text-sm font-bold mb-2">Número de Identificación:</label>
                <input type="number" id="numero_identificacion_socio" name="numero_identificacion_socio" value="{{ old('numero_identificacion_socio') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_registro_socio" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Registro:</label>
                <input type="date" id="fecha_registro_socio" name="fecha_registro_socio" value="{{ old('fecha_registro_socio') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="numero_acciones" class="block text-gray-700 text-sm font-bold mb-2">Número de Acciones ó Porcentaje:</label>
                <input type="text" id="numero_acciones" name="numero_acciones" value="{{ old('numero_acciones') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="numero_titulo" class="block text-gray-700 text-sm font-bold mb-2">Número de Título:</label>
                <input type="text" id="numero_titulo" name="numero_titulo" value="{{ old('numero_titulo') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <h2 class="text-xl font-semibold text-center mt-4">Resolución de Facturación</h2>
            <div class="mb-4">
                <label for="numero_resolucion" class="block text-gray-700 text-sm font-bold mb-2">Número Resolución:</label>
                <input type="text" id="numero_resolucion" name="numero_resolucion" value="{{ old('numero_resolucion') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="fecha_resolucion" class="block text-gray-700 text-sm font-bold mb-2">Fecha Resolución:</label>
                <input type="date" id="fecha_resolucion" name="fecha_resolucion" value="{{ old('fecha_resolucion') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="rangos_numeracion" class="block text-gray-700 text-sm font-bold mb-2">Rangos de Numeración:</label>
                <input type="text" id="rangos_numeracion" name="rangos_numeracion" value="{{ old('rangos_numeracion') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="observaciones" class="block text-gray-700 text-sm font-bold mb-2">Observaciones:</label>
                <textarea  id="observaciones" name="observaciones" value="{{ old('observaciones') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full"></textarea>
            </div>
            <div>

            </div>
            <div class="mb-4">
                <label for="logo" class="block text-gray-700 text-sm font-bold mb-2">Logotipo:</label>
                <input type="file" id="logo" name="logo" value="{{ old('logo') }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="tamano_empresa" class="block text-gray-700 text-sm font-bold mb-2">Tamaño de Empresa:</label>
                <select name="tamano_empresa" id="tamano_empresa" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($tamanosEmpresa as $tamano_empresa)
                        <option value="{{ $tamano_empresa }}">{{ $tamano_empresa }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Botón para crear la empresa -->
            <div class="mt-8">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Empresa</button>
            </div>

            </div> <!-- Columna derecha -->
        </form>

</div>
<!-- Fin formulario crear empresa -->


<!-- JS para ocultar campos -->
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const personaJuridicaSelect = document.getElementById('persona_juridica');
            const fieldsToDisable = document.getElementById('fields_to_disable').querySelectorAll('input');

            function toggleFields() {
                const isDisabled = personaJuridicaSelect.value === '1';
                fieldsToDisable.forEach(field => {
                    field.disabled = isDisabled;
                });
            }

            // Inicializa el estado de los campos según el valor inicial
            toggleFields();

            // Agrega el evento change al select
            personaJuridicaSelect.addEventListener('change', toggleFields);
        });
    </script>


<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->

</body>
</html>