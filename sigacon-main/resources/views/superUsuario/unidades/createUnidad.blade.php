<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Crear una Unidad</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<h2 class="text-xl font-semibold text-center mt-4">Agregar Nueva Unidad a la empresa seleccionada anteriormente</h2>


<!-- Formulario para Crear una Nueva Unidad -->
<form action="{{ route('unidades.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="grid grid-cols-1 gap-4">
            <!-- Mostrar la Empresa Seleccionada -->
            <div class="flex justify-center">
                <div class="w-full max-w-md">
                    <label for="empresa_id" class="block text-gray-700 text-sm font-bold mb-2">Empresa Propiedad Horizontal</label>
                    <input type="text" value="{{ $empresa->razon_social }}" class="border border-gray-400 rounded-md py-2 px-3 w-full bg-gray-100" disabled>
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                </div>
            </div>

            <!-- Campos de la Unidad -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Tipo de Unidad -->
                <div class="w-4/5 mx-auto">
                    <label for="tipoUnidad" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Unidad</label>
                    <input type="text" name="tipoUnidad" id="tipoUnidad" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
                </div>

                <!-- Torre/Bloque -->
                <div class="w-4/5 mx-auto">
                    <label for="torreBloque" class="block text-gray-700 text-sm font-bold mb-2">Torre/Bloque</label>
                    <input type="text" name="torreBloque" id="torreBloque" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
                </div>

                <!-- Número de Unidad -->
                <div class="w-4/5 mx-auto">
                    <label for="number" class="block text-gray-700 text-sm font-bold mb-2">Número</label>
                    <input type="text" name="number" id="number" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
                </div>

                <!-- Matrícula Inmobiliaria -->
                <div class="w-4/5 mx-auto">
                    <label for="matriculaInmobiliaria" class="block text-gray-700 text-sm font-bold mb-2">Matrícula Inmobiliaria</label>
                    <input type="text" name="matriculaInmobiliaria" id="matriculaInmobiliaria" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
                </div>

                <!-- Ficha Catastral -->
                <div class="w-4/5 mx-auto">
                    <label for="fichaCatastral" class="block text-gray-700 text-sm font-bold mb-2">Ficha Catastral</label>
                    <input type="text" name="fichaCatastral" id="fichaCatastral" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
                </div>

                <!-- Área en m² -->
                <div class="w-4/5 mx-auto">
                    <label for="areaMt2" class="block text-gray-700 text-sm font-bold mb-2">Área (m²)</label>
                    <input type="number" name="areaMt2" id="areaMt2" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Propietario -->
                <div class="w-4/5 mx-auto">
                    <label for="propietario" class="block text-gray-700 text-sm font-bold mb-2">Propietario</label>
                    <input type="text" name="propietario" id="propietario" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
                </div>

                <!-- Garaje -->
                <div class="w-4/5 mx-auto">
                    <label for="garaje" class="block text-gray-700 text-sm font-bold mb-2">Garaje</label>
                    <input type="text" name="garaje" id="garaje" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                </div>

                <!-- Porcentaje de Unidad -->
                <div class="w-4/5 mx-auto">
                    <label for="porcentajeUnidad" class="block text-gray-700 text-sm font-bold mb-2">Porcentaje de Unidad</label>
                    <input type="number" name="porcentajeUnidad" id="porcentajeUnidad" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Total del Coeficiente -->
                <div class="w-4/5 mx-auto">
                    <label for="totalCoeficiente" class="block text-gray-700 text-sm font-bold mb-2">Total Coeficiente</label>
                    <input type="number" name="totalCoeficiente" id="totalCoeficiente" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>
            </div>
        </div>

        <!-- Botón para Enviar el Formulario -->
        <div class="mt-8 text-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Unidad</button>
        </div>
    </form>
</div>





<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->
    
</body>
</html>