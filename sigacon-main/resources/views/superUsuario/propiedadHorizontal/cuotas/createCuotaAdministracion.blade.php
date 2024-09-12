<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Crear Cuota Administración</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <h2 class="text-xl font-semibold text-center mt-4">Agregar Nueva Cuota de Administración</h2>

    <!-- Formulario para Crear una Nueva Cuota -->
    <div class="max-w-4xl mx-auto px-4">
        <form action="{{ route('cuotas.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Nombre de la Cuota -->
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Cuota (Para Identificarla)</label>
                <input type="text" name="nombre" id="nombre" class="border border-gray-400 rounded-md py-2 px-3 w-full" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Cuota Mensual 1 -->
                <div>
                    <label for="cuotaMensual1" class="block text-gray-700 text-sm font-bold mb-2">Cuota Mensual 1</label>
                    <input type="number" name="cuotaMensual1" id="cuotaMensual1" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Cuota Mensual 1 Sin Descuento -->
                <div>
                    <label for="cuotaMensual1SinDescuento" class="block text-gray-700 text-sm font-bold mb-2">Cuota Mensual 2 Sin Descuento</label>
                    <input type="number" name="cuotaMensual1SinDescuento" id="cuotaMensual1SinDescuento" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Descuento -->
                <div>
                    <label for="descuento" class="block text-gray-700 text-sm font-bold mb-2">Descuento</label>
                    <input type="number" name="descuento" id="descuento" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Cuota Mensual 2 Descuento -->
                <div>
                    <label for="cuotaMensual2Descuento" class="block text-gray-700 text-sm font-bold mb-2">Cuota Mensual 2 Descuento</label>
                    <input type="number" name="cuotaMensual2Descuento" id="cuotaMensual2Descuento" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Diferencia Mensual Incremento -->
                <div>
                    <label for="diferenciaMensualIncremento" class="block text-gray-700 text-sm font-bold mb-2">Diferencia Mensual Incremento</label>
                    <input type="number" name="diferenciaMensualIncremento" id="diferenciaMensualIncremento" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Valor Retroactivo -->
                <div>
                    <label for="valorRetroactivo" class="block text-gray-700 text-sm font-bold mb-2">Valor Retroactivo</label>
                    <input type="number" name="valorRetroactivo" id="valorRetroactivo" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>

                <!-- Total a Pagar Sin Descuento -->
                <div>
                    <label for="totalPagarSinDescuento" class="block text-gray-700 text-sm font-bold mb-2">Total a Pagar Sin Descuento</label>
                    <input type="number" name="totalPagarSinDescuento" id="totalPagarSinDescuento" class="border border-gray-400 rounded-md py-2 px-3 w-full" required step="0.01">
                </div>
            </div>

            <!-- Botón para Enviar el Formulario -->
            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cuota</button>
            </div>
        </form>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->
    
</body>
</html>
