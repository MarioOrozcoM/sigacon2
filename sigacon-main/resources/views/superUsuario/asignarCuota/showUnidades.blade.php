<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Seleccionar Unidad(s)</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->
     
    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Seleccionar 1 o varias Unidades de la empresa previamente seleccionada</h1>
    </div>    

    <!-- Lista de Unidades -->
    <div class="max-w-4xl mx-auto px-4">
        <form action="{{ route('cuotas.assign', ['cuota' => $cuotaId, 'empresa' => $empresaId]) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <input type="hidden" name="cuota_id" value="{{ $cuotaId }}">
        <input type="hidden" name="empresa_id" value="{{ $empresaId }}">

        <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
            @forelse($unidades as $unidad)
                <li class="flex justify-between items-center p-4 gap-4">
                    <span class="text-gray-700 font-medium">{{ $unidad->propietario }} - {{ $unidad->tipoUnidad }}</span>
                    <input type="checkbox" name="unidad_ids[]" value="{{ $unidad->id }}" class="form-checkbox h-5 w-5 text-green-600">
                </li>
            @empty
                <li class="p-4 text-gray-500">No hay unidades disponibles para la empresa seleccionada.</li>
            @endforelse
        </ul>



        <!-- Botón para Asignar Cuota -->
        <div class="mt-6 text-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Asignar Cuota a las Unidades Seleccionadas
            </button>
        </div>
        </form>

    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->      

</body>
</html>
