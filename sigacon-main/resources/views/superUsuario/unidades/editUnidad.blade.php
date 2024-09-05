<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Editar la Unidad</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <h2 class="text-xl font-semibold text-center mt-4">Editar los datos básicos de la unidad seleccionada</h2>

    <!-- Formulario para Editar la Unidad Seleccionada -->
    <form action="{{ route('unidades.update', $unidad->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto mt-6">
        @csrf
        @method('PUT')

        <!-- Mostrar la Empresa Seleccionada (No Editable) -->
        <div class="mb-4">
            <label for="empresa_id" class="block text-gray-700 text-sm font-bold mb-2">Empresa Propiedad Horizontal</label>
            <input type="text" value="{{ $unidad->empresa->razon_social }}" class="border border-gray-400 rounded-md py-2 px-3 w-full bg-gray-100" disabled>
            <input type="hidden" name="empresa_id" value="{{ $unidad->empresa->id }}">
        </div>

        <!-- Campos de la Unidad -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Tipo de Unidad -->
            <div>
                <label for="tipoUnidad" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Unidad</label>
                <input type="text" name="tipoUnidad" id="tipoUnidad" value="{{ $unidad->tipoUnidad }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
            </div>

            <!-- Torre/Bloque -->
            <div>
                <label for="torreBloque" class="block text-gray-700 text-sm font-bold mb-2">Torre/Bloque</label>
                <input type="text" name="torreBloque" id="torreBloque" value="{{ $unidad->torreBloque }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
            </div>

            <!-- Número de Unidad -->
            <div>
                <label for="number" class="block text-gray-700 text-sm font-bold mb-2">Número</label>
                <input type="text" name="number" id="number" value="{{ $unidad->number }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
            </div>

            <!-- Matrícula Inmobiliaria -->
            <div>
                <label for="matriculaInmobiliaria" class="block text-gray-700 text-sm font-bold mb-2">Matrícula Inmobiliaria</label>
                <input type="text" name="matriculaInmobiliaria" id="matriculaInmobiliaria" value="{{ $unidad->matriculaInmobiliaria }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
            </div>

            <!-- Ficha Catastral -->
            <div>
                <label for="fichaCatastral" class="block text-gray-700 text-sm font-bold mb-2">Ficha Catastral</label>
                <input type="text" name="fichaCatastral" id="fichaCatastral" value="{{ $unidad->fichaCatastral }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
            </div>

            <!-- Área en m² -->
            <div>
                <label for="areaMt2" class="block text-gray-700 text-sm font-bold mb-2">Área (m²)</label>
                <input type="number" name="areaMt2" id="areaMt2" value="{{ $unidad->areaMt2 }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
            </div>

            <!-- Propietario -->
            <div>
                <label for="propietario" class="block text-gray-700 text-sm font-bold mb-2">Propietario</label>
                <input type="text" name="propietario" id="propietario" value="{{ $unidad->propietario }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
            </div>

            <!-- Garaje -->
            <div>
                <label for="garaje" class="block text-gray-700 text-sm font-bold mb-2">Garaje</label>
                <input type="text" name="garaje" id="garaje" value="{{ $unidad->garaje }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>

            <!-- Porcentaje de Unidad -->
            <div>
                <label for="porcentajeUnidad" class="block text-gray-700 text-sm font-bold mb-2">Porcentaje de Unidad</label>
                <input type="number" name="porcentajeUnidad" id="porcentajeUnidad" value="{{ $unidad->porcentajeUnidad }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
            </div>

            <!-- Total del Coeficiente -->
            <div>
                <label for="totalCoeficiente" class="block text-gray-700 text-sm font-bold mb-2">Total Coeficiente</label>
                <input type="number" name="totalCoeficiente" id="totalCoeficiente" value="{{ $unidad->totalCoeficiente }}" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
            </div>
        </div>

        <!-- Botón para Guardar Cambios -->
        <div class="mt-8 text-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>
        </div>
    </form>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->
    
</body>
</html>