<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Admin | Conceptos</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('includes.header_redirect_main') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black mb-12">Administrar Conceptos</h1>
        <a href="{{ route('conceptos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-8">Crear Nuevo Concepto</a>
    </div>

    <!-- Lista de Conceptos -->
    <div class="max-w-4xl mx-auto px-4">
        <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
            @forelse($conceptos as $concepto)
                <li class="p-4 flex justify-between items-center">
                    <span class="text-gray-700 font-medium">{{ $concepto->nombreConcepto }}</span>
                    <form action="{{ route('conceptos.destroy', $concepto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este concepto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4">Eliminar</button>
                    </form>
                </li>
            @empty
                <li class="p-4 text-gray-500">No hay conceptos disponibles.</li>
            @endforelse
        </ul>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->

</body>
</html>