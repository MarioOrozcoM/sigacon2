<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Cuotas para asignar</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Cuotas de Administración Disponibles</h1>
    </div>

    <!-- Lista de Cuotas -->
    <div class="max-w-4xl mx-auto px-4">
        <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
            @foreach($cuotas as $cuota)
                <li class="flex justify-between items-center p-4 gap-4"> <!-- Añadido gap-4 -->
                    <span class="text-gray-700 font-medium">{{ $cuota->nombre }}</span>
                    <a href="{{ route('cuotas.empresas', $cuota->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Seleccionar
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->    

</body>
</html>
