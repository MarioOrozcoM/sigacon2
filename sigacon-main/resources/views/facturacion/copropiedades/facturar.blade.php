<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Facturación | Copropiedades</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('includes.header_redirect_main')
    <!-- Fin navegación superior -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Generar Factura para Propiedad Horizontal</h1>
    </div>

    <!-- Selector de Empresa -->
    <form action="{{ route('facturas.seleccionar') }}" method="GET" class="flex justify-center items-center gap-4 mb-4">
        <label for="empresa_id" class="text-lg">Selecciona una Empresa:</label>
        <select name="empresa_id" id="empresa_id" class="border p-2">
            <option value="">Seleccione una empresa</option>
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa->id }}" {{ request('empresa_id') == $empresa->id ? 'selected' : '' }}>
                    {{ $empresa->razon_social }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mostrar Cuotas</button>
    </form>
    <!-- Selector de Empresa FIN -->

    <!-- Mostrar Cuotas Asignadas -->
    @if (!empty($cuotas))
        <form action="{{ route('facturas.generar') }}" method="POST">
            @csrf
            <input type="hidden" name="empresa_id" value="{{ request('empresa_id') }}">

            <!-- Tabla para mostrar cuotas con tamaño reducido -->
            <table class="table-auto w-full max-w-3xl bg-white shadow-md rounded mx-auto mt-2">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Seleccionar</th>
                        <th class="px-4 py-2">Concepto</th>
                        <th class="px-4 py-2">Tipo de Cuota</th>
                        <th class="px-4 py-2">Unidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuotas as $cuota)
                        @foreach ($cuota->unidades as $unidad)
                            <tr class="border-t">
                                <td class="px-4 py-2">
                                    <input type="checkbox" name="cuotas[]" value="{{ $cuota->id }}">
                                </td>
                                <td class="px-4 py-2">{{ optional($cuota->concepto)->nombreConcepto ?? 'Sin concepto' }}</td>
                                <td class="px-4 py-2">{{ $cuota->tipo }}</td>
                                <td class="px-4 py-2">
                                    {{ $unidad->tipoUnidad ?? 'Sin tipo' }} {{ $unidad->number ?? 'Sin número' }}  - 
                                    {{ $unidad->torreBloque ? 'Torre/Bloque ' . $unidad->torreBloque : '' }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <!-- Selección de descuento -->
            <div class="mt-4 text-center">
                <label class="font-medium block mb-2">Tipo de descuento:</label>
                <div class="flex justify-center items-center gap-4">
                    <label for="tipo_descuento_porcentaje" class="flex items-center">
                        <input type="radio" id="tipo_descuento_porcentaje" name="tipo_descuento" value="porcentaje" class="mr-2" checked>
                        Porcentaje (%)
                    </label>
                    <label for="tipo_descuento_valor" class="flex items-center">
                        <input type="radio" id="tipo_descuento_valor" name="tipo_descuento" value="valor" class="mr-2">
                        Valor Fijo ($)
                    </label>
                </div>
            </div>

            <!-- Campos de descuento -->
            <div class="mt-4 text-center">
                <label class="font-medium block mb-1" for="dias_pronto_pago">Días para pronto pago:</label>
                <input type="number" id="dias_pronto_pago" name="dias_pronto_pago" class="border p-2 rounded w-1/3" placeholder="Ej: 5" >

                <div id="campo_porcentaje" class="mt-4">
                    <label class="font-medium block mb-1" for="porcentaje_descuento">Porcentaje de descuento:</label>
                    <input type="number" id="porcentaje_descuento" name="porcentaje_descuento" class="border p-2 rounded w-1/3" placeholder="Ej: 10">
                </div>

                <div id="campo_valor" class="mt-4 hidden">
                    <label class="font-medium block mb-1" for="valor_descuento">Valor del descuento:</label>
                    <input type="number" id="valor_descuento" name="valor_descuento" class="border p-2 rounded w-1/3" placeholder="Ej: 5.000">
                </div>
            </div>

            <!-- Botón para generar la factura -->
            <div class="text-center mt-4">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Generar Factura</button>
            </div>
        </form>
        
        <!-- Facturación en Bloque -->
        <div class="text-center mt-6 mb-4">
            <a href="{{ route('facturas.bloque.configurar', ['empresa_id' => request('empresa_id')]) }}" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Facturación en Bloque
            </a>
        </div>
    @else
        <p class="text-center">Seleccione una empresa para ver las cuotas asignadas.</p>
    @endif

    <!-- Inicio Footer -->
    @include('includes.footer')
    <!-- Cierre Footer -->

    <script>
        // Mostrar u ocultar los campos de descuento según el tipo seleccionado
        document.addEventListener('DOMContentLoaded', function () {
            const tipoDescuentoPorcentaje = document.getElementById('tipo_descuento_porcentaje');
            const tipoDescuentoValor = document.getElementById('tipo_descuento_valor');
            const campoPorcentaje = document.getElementById('campo_porcentaje');
            const campoValor = document.getElementById('campo_valor');

            tipoDescuentoPorcentaje.addEventListener('change', function () {
                if (this.checked) {
                    campoPorcentaje.classList.remove('hidden');
                    campoValor.classList.add('hidden');
                }
            });

            tipoDescuentoValor.addEventListener('change', function () {
                if (this.checked) {
                    campoValor.classList.remove('hidden');
                    campoPorcentaje.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
