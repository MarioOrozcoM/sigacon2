<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Admin | Cuotas PH</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('includes.header_redirect_main') <!-- HEADER -->
    <!-- Fin navegación superior -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Administrar Cuotas de Propiedad Horizontal</h1>
    </div>

    <div class="max-w-80rem mx-auto px-4"> <!-- Cambiar a max-w-80rem -->
        <form action="{{ route('cuotasPH.index') }}" method="GET" class="mb-4">
            <label for="empresa_id" class="mr-2">Selecciona una Empresa:</label>
            <select name="empresa_id" id="empresa_id" required class="border p-2">
                <option value="">Seleccione una empresa</option>
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}" {{ $empresa_id == $empresa->id ? 'selected' : '' }}>
                        {{ $empresa->razon_social }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mostrar Unidades</button>
        </form>

        @if (!empty($empresa_id))
            <!-- Botones, crear, editar, exportar -->
            <div class="flex justify-between mb-4">
                <a href="{{ route('cuotasPH.create', ['empresa_id' => $empresa_id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Crear Cuota</a>
                <button id="editar-btn" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Editar Valores</button>
                <a href="{{ route('cuotasPH.export', ['empresa_id' => $empresa_id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Exportar a Excel</a>
            </div>
        @endif

        @if (!empty($unidades))
            <div class="flex">
                <form action="{{ route('cuotasPH.update') }}" method="POST" class="flex-grow">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="empresa_id" value="{{ $empresa_id }}">
                    <table class="table-auto w-full bg-white shadow-md rounded">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">Concepto</th>
                                <th class="px-4 py-2">Tipo de Cuota</th>
                                <th class="px-4 py-2">Valor Individual</th>
                                <th class="px-4 py-2">Fecha(s)</th>
                                <th class="px-4 py-2">Empresa</th>
                                <th class="px-4 py-2">Unidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($unidades as $unidad)
                                @foreach ($unidad->cuotasUnidad as $cuota)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ optional($cuota->cuotaPH->concepto)->nombreConcepto ?? 'Sin concepto' }}</td>
                                        <td class="px-4 py-2">{{ $cuota->cuotaPH->tipo ?? 'Sin tipo de cuota' }}</td>
                                        <td class="px-4 py-2">
                                            <input type="number" name="valores[{{ $cuota->cuotaPH->id }}]" value="{{ $cuota->cuotaPH->vrlIndividual ?? '0' }}" class="border p-2 w-full text-center bg-gray-100" disabled>
                                            <input type="hidden" name="cuota_id" value="{{ $cuota->cuotaPH->id }}"> <!-- Añadido para almacenar el ID de la cuota -->
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $cuota->cuotaPH->desde ??  'No definida' }} - {{ $cuota->cuotaPH->hasta ??  'No definida' }}
                                        </td>
                                        <td>
                                            <span>{{ $unidad->empresa->razon_social ?? 'Sin Empresa' }}</span>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <span>{{ $unidad->tipoUnidad }} {{ $unidad->number }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center">No hay unidades con cuotas asignadas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>
                    </div>
                </form>

                <!-- Columna de acciones para eliminar -->
                <div class="flex flex-col ml-4"> <!-- Espaciado a la izquierda -->
                    <div class="h-14"></div> <!-- Fila en blanco -->
                    @foreach ($unidades as $unidad)
                        @foreach ($unidad->cuotasUnidad as $cuota)
                            <form action="{{ route('cuotasPH.destroy', $cuota->cuotaPH->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta cuota?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded mb-6">Eliminar</button>
                                <!-- <p class="text-xs">ID de Cuota: {{ $cuota->cuotaPH->id }}</p> Línea para depurar -->
                            </form>
                        @endforeach
                    @endforeach
                </div>

            </div>

        @else
            <p class="text-center">No hay unidades con cuotas asignadas para esta empresa.</p>
        @endif
    </div>


    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->

    <script>
        document.getElementById('editar-btn').addEventListener('click', function() {
            // Habilitar todos los campos de edición
            document.querySelectorAll('input[type="number"]').forEach(function(input) {
                input.disabled = !input.disabled;
                input.classList.toggle('bg-gray-100');
            });
        });
    </script>

</body>
</html>
