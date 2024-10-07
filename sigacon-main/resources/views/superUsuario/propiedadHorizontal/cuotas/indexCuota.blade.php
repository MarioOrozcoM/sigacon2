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

    <div class="max-w-4xl mx-auto px-4">
        <!-- Cambiar la acción del formulario -->
        <form action="{{ route('cuotasPH.index') }}" method="GET" class="mb-4">
            <label for="empresa_id" class="mr-2">Selecciona una Empresa:</label>
            <select name="empresa_id" id="empresa_id" required class="border p-2">
                <option value="">Seleccione una empresa</option>
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mostrar Unidades</button>
        </form>

        @if (!empty($empresa_id))
            <div class="flex justify-end mb-4">
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('cuotasPH.create', ['empresa_id' => $empresa_id]) }}">Crear Cuota para "{{ $empresas->firstWhere('id', $empresa_id)->razon_social }}"</a>
            </div>
        @endif


        @if (!empty($unidades))
            <table class="table-auto w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Concepto</th>
                        <th class="px-4 py-2">Valor Individual</th>
                        <th class="px-4 py-2">Empresa</th>
                        <th class="px-4 py-2">Unidad</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unidades as $unidad)
                        @foreach ($unidad->cuotasUnidad as $cuota)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ optional($cuota->cuotaPH->concepto)->nombreConcepto ?? 'Sin concepto' }}</td>
                                <td class="px-4 py-2">$ {{ $cuota->cuotaPH->vrlIndividual ?? '0' }}</td>
                                <td>
                                    <span>{{ $unidad->empresa->razon_social ?? 'Sin Empresa' }}</span>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <span>{{ $unidad->tipoUnidad }} {{ $unidad->number }}</span> <!-- Mostrando tipoUnidad y number -->
                                </td>
                                <td class="px-4 py-2 flex justify-around gap-4">
                                    <a href="{{ route('cuotasPH.edit', $cuota->cuotaPH->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-4 rounded">Editar</a>
                                    <form action="{{ route('cuotasPH.destroy', $cuota->cuotaPH->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta cuota?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center">No hay unidades con cuotas asignadas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            <p class="text-center">No hay unidades con cuotas asignadas para esta empresa.</p>
        @endif
    </div>

    @if (!empty($empresa_id))
        <div class="flex justify-center mb-4 mt-6 gap-8">

            <div>
                <a href="{{ route('cuotasPH.export', ['empresa_id' => $empresa_id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Exportar a Excel</a>
            </div>

            <!-- Formulario de importación sin necesidad de volver a seleccionar la empresa -->
            <form action="{{ route('cuotasPH.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf
                <!-- Campo oculto para enviar la empresa seleccionada -->
                <input type="hidden" name="empresa_id" value="{{ $empresa_id }}">
                
                <!-- Campo para seleccionar el archivo de Excel -->
                <input type="file" name="file" required class="mt-2">
                
                <!-- Botón de importar -->
                <button type="submit" class="btn btn-success bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Importar desde Excel</button>
            </form>

        </div>
    @endif



    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->
    
</body>
</html>
