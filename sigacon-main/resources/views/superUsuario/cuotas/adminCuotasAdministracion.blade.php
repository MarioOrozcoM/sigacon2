<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Admin Cuotas Administración</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('superUsuario.headerSuper') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <!-- Inicio rol -->
    @include('includes.show_rol')
    <!-- Fin rol -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Administrar Cuotas de Administración</h1>
    </div>

    <!-- Botón para Crear Nueva Cuota -->
    <div class="text-center mb-4">
        <a href="{{ route('cuotas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear Nueva Cuota</a>
    </div>

    <!-- Mostrar las Cuotas de Administración -->
    <div class="overflow-x-auto px-4">
        <div class="max-w-3xl mx-auto"> <!-- Ajusta el ancho máximo de la tabla al 60% -->
            <table class="w-full bg-white border border-gray-200 shadow-md">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">Nombre de la Cuota</th>
                        <th class="py-2 px-4 border-b text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cuotas as $cuota)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $cuota->nombre }}</td>
                            <td class="py-2 px-4 border-b flex gap-2">
                                <!-- Botón para Editar la Cuota -->
                                <a href="{{ route('cuotas.edit', $cuota->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>

                                <!-- Botón para Eliminar la Cuota -->
                                <form action="{{ route('cuotas.destroy', $cuota->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro de eliminar esta cuota?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->

</body>
</html>
