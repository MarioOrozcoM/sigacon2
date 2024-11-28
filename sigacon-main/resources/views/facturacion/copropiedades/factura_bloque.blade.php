<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Facturación en Bloque</title>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Encabezado -->
    @include('includes.header_redirect_main')

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black mb-4">Facturación en Bloque</h1>
        <p class="text-gray-700 text-lg">
            Facturación masiva para el concepto <strong>Cuota Administración</strong>
            @if ($empresa)
                de la empresa <strong>{{ $empresa->razon_social }}</strong>
            @endif
        </p>
        <p class="text-gray-700 mt-2 text-base">
            Total de facturas a generar: <strong>{{ $totalFacturas }}</strong>
        </p>
    </div>

    <!-- Formulario -->
    <form action="{{ route('facturas.bloque.generar') }}" method="POST" class="max-w-lg mx-auto bg-white p-4 rounded shadow">
        @csrf
        @if ($empresa)
            <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
        @endif

        <!-- Días para pronto pago -->
        <div class="mb-4">
            <label for="dias_pronto_pago" class="block font-medium mb-1 text-lg">Días para pronto pago</label>
            <input type="number" id="dias_pronto_pago" name="dias_pronto_pago" class="w-full border p-2 rounded" placeholder="Ej: 5" >
        </div>

        <!-- Tipo de descuento -->
        <div class="mb-4">
            <label class="block font-medium mb-1 text-lg">Tipo de descuento</label>
            <div class="flex items-center">
                <label class="mr-4">
                    <input type="radio" name="tipo_descuento" value="porcentaje" checked>
                    Porcentaje
                </label>
                <label>
                    <input type="radio" name="tipo_descuento" value="valor">
                    Valor Fijo
                </label>
            </div>
        </div>

        <!-- Porcentaje de descuento -->
        <div class="mb-4" id="input-porcentaje">
            <label for="porcentaje_descuento" class="block font-medium mb-1 text-lg">Porcentaje de descuento</label>
            <input type="number" id="porcentaje_descuento" name="porcentaje_descuento" class="w-full border p-2 rounded" placeholder="Ej: 10">
        </div>

        <!-- Valor de descuento -->
        <div class="mb-4" id="input-valor" style="display: none;">
            <label for="valor_descuento" class="block font-medium mb-1 text-lg">Valor de descuento</label>
            <input type="number" id="valor_descuento" name="valor_descuento" class="w-full border p-2 rounded" placeholder="Ej: 5.000">
        </div>

        <!-- Botón de envío -->
        <div class="text-center">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Generar Facturación en Bloque
            </button>
        </div>
    </form>

    <!-- Pie de página -->
    @include('includes.footer')

    <!-- Script para manejar el tipo de descuento -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipoDescuentoInputs = document.querySelectorAll('input[name="tipo_descuento"]');
            const inputPorcentaje = document.getElementById('input-porcentaje');
            const inputValor = document.getElementById('input-valor');

            tipoDescuentoInputs.forEach(input => {
                input.addEventListener('change', () => {
                    if (input.value === 'porcentaje') {
                        inputPorcentaje.style.display = 'block';
                        inputValor.style.display = 'none';
                    } else {
                        inputPorcentaje.style.display = 'none';
                        inputValor.style.display = 'block';
                    }
                });
            });
        });
    </script>
</body>
</html>
