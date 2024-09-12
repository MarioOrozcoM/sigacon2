<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Unidades de la Empresa</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->
     
    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Unidades de {{ $empresa->razon_social }}</h1>
    </div>    

    <!-- Lista de Unidades -->
    <div class="max-w-4xl mx-auto px-4">
        <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
            @forelse($unidades as $unidad)
                <li class="p-4 flex justify-between items-center">
                    <span class="text-gray-700 font-medium mr-4">{{ $unidad->propietario }} - {{ $unidad->tipoUnidad }} - {{ $unidad->number }}</span>

                    <!-- Mostrar cuotas asignadas -->
                    @if($unidad->cuotas->isNotEmpty())
                        <ul>
                            @foreach($unidad->cuotas as $cuota)
                                <li class="flex justify-between items-center">
                                    <span class="text-gray-700 mr-4">{{ $cuota->nombre }}</span>

                                    <!-- Formulario para eliminar la cuota -->
                                    <form action="{{ route('revisar.removeCuota', ['empresa' => $empresa->id, 'unidad' => $unidad->id]) }}" method="POST">
                                        @csrf <!-- Protege el formulario contra CSRF -->
                                        <!-- Campo oculto para enviar el ID de la cuota que se desea eliminar -->
                                        <input type="hidden" name="cuota_id" value="{{ $cuota->id }}">
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                            Eliminar Cuota
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-gray-500">No hay cuotas asignadas.</span>
                    @endif
                </li>
            @empty
                <li class="p-4 text-gray-500">No hay unidades disponibles para la empresa seleccionada.</li>
            @endforelse
        </ul>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->      

</body>
</html>
