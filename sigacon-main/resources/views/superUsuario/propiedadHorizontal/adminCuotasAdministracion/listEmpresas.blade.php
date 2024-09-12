<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Empresas de Propiedad Horizontal</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->
     
    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Empresas de Propiedad Horizontal</h1>
    </div>    

    <!-- Lista de Empresas -->
    <div class="max-w-4xl mx-auto px-4">
        <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
            @forelse($empresas as $empresa)
                <li class="p-4 flex justify-between items-center">
                    <span class="text-gray-700 font-medium">{{ $empresa->razon_social }}</span>
                    <a href="{{ route('revisar.unidades', $empresa->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">
                        Ver Unidades
                    </a>
                </li>
            @empty
                <li class="p-4 text-gray-500">No hay empresas de propiedad horizontal disponibles.</li>
            @endforelse
        </ul>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->      

</body>
</html>