<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Seleccionar Empresa</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Seleccionar Empresa de Propiedad Horizontal</h1>
    </div>    

    <!-- Lista de Empresas -->
    <div class="max-w-4xl mx-auto px-4">
        <ul class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
            @foreach($empresas as $empresa)
                <li class="flex justify-between items-center p-4 gap-4"> <!-- Añadido gap-4 para separación -->
                    <span class="text-gray-700 font-medium">{{ $empresa->razon_social }}</span>
                    <a href="{{ route('cuotas.unidades', [$cuotaId, $empresa->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
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
