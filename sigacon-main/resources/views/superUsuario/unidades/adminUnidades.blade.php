<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Administrar Unidades</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Administrar Unidades de Propiedad Horizontal</h1>
    </div>

    <!-- Selector para Filtrar Empresas por Tipo "Propiedad Horizontal" -->
    <form action="{{ route('unidades.index') }}" method="GET" class="flex justify-center mb-4">
        <label for="empresa" class="mr-2 text-lg">Selecciona una Empresa:</label>
        <select name="empresa_id" id="empresa" class="border rounded p-2" onchange="this.form.submit()">
            <option value="">-- Selecciona una Empresa --</option>
            @foreach($empresas as $empresa)
                <option value="{{ $empresa->id }}" {{ request('empresa_id') == $empresa->id ? 'selected' : '' }}>
                    {{ $empresa->razon_social }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Barra de Búsqueda para Filtrar Unidades -->
    @if(request('empresa_id'))
        <div class="flex justify-center mb-4">
            <input type="text" id="searchPropietario" placeholder="Buscar por Propietario" class="border rounded p-2 mr-2">
            <input type="text" id="searchNumber" placeholder="Buscar por Número" class="border rounded p-2">
        </div>
    @endif

    <!-- Botón para Crear Nueva Unidad -->
    @if(request('empresa_id'))
        <div class="text-center mt-4">
            <a href="{{ route('unidades.create', ['empresa_id' => request('empresa_id')]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear Nueva Unidad</a>
        </div>
    @endif

    <!-- Mostrar las Unidades de la Empresa Seleccionada -->
<div class="overflow-x-auto px-4">
    <table class="w-3/4 mx-auto mt-10 bg-white border border-gray-200 shadow-md">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b text-left">Tipo de Unidad</th>
                <th class="py-2 px-4 border-b text-left">Torre/Bloque</th>
                <th class="py-2 px-4 border-b text-left">Número</th>
                <th class="py-2 px-4 border-b text-left">Propietario</th>
                <th class="py-2 px-4 border-b text-left w-1/6">Acciones</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($unidades as $unidad)
                @if(request('empresa_id') == $unidad->empresa_id)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $unidad->tipoUnidad }}</td>
                        <td class="py-2 px-4 border-b">{{ $unidad->torreBloque }}</td>
                        <td class="py-2 px-4 border-b">{{ $unidad->number }}</td>
                        <td class="py-2 px-4 border-b">{{ $unidad->propietario }}</td>
                        <td class="py-2 px-4 border-b">
                            <!-- Contenedor Flex con Separación entre los Botones -->
                            <div class="flex space-x-4">
                                <!-- Botón para Editar la Unidad -->
                                <a href="{{ route('unidades.edit', $unidad->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>

                                <!-- Botón para Eliminar la Unidad con Confirmación -->
                                <form action="{{ route('unidades.destroy', $unidad->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('¿Estás seguro de eliminar esta unidad? Esta acción no se puede deshacer.')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>




    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->

    <!-- Script para la búsqueda en JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchPropietario = document.getElementById('searchPropietario');
            const searchNumber = document.getElementById('searchNumber');
            const tableRows = document.querySelectorAll('#unidadesTable tbody tr');

            function filterTable() {
                const propietarioValue = searchPropietario.value.toLowerCase();
                const numberValue = searchNumber.value.toLowerCase();

                tableRows.forEach(row => {
                    const propietario = row.querySelector('.unidad-propietario').textContent.toLowerCase();
                    const number = row.querySelector('.unidad-number').textContent.toLowerCase();

                    if ((propietario.includes(propietarioValue) || !propietarioValue) &&
                        (number.includes(numberValue) || !numberValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchPropietario.addEventListener('input', filterTable);
            searchNumber.addEventListener('input', filterTable);
        });
    </script>

</body>
</html>
