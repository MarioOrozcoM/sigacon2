<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Empresas</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<!-- Inicio rol -->
@include('includes.show_rol')
<!-- Fin rol -->

<div class="text-center">
    <h1 class="text-bold text-2xl text-black">Administrar Empresas</h1>
</div>

<!-- Inicio Administrar Empresas -->
<div class="container mx-auto px-4 mt-8">
    <h2 class="text-xl font-semibold">Lista de Empresas</h2>
    <!-- Barra de búsqueda -->
    <div class="mt-4">
        <input type="text" id="searchInput" placeholder="Buscar por nombre comercial" class="border border-gray-400 px-4 py-2 mb-4 mr-6">
        <!-- Agregar Empresa -->
        <a href="{{ route('empresas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Agregar Empresa</a>
    </div>

    <!-- Lista de Empresas -->
    <table class="w-full border-collapse border border-gray-400">
        <thead>
            <tr class="uppercase">
                <th class="border border-gray-400 px-4 py-2 w-1/6">Código Empresa</th>
                <th class="border border-gray-400 px-4 py-2 w-1/3">Nombre Comercial</th>
                <th class="border border-gray-400 px-4 py-2 w-1/4">Logotipo</th>
                <th class="border border-gray-400 px-4 py-2 w-1/12">Acciones</th>
            </t
        </thead>
        <tbody>
            <!-- Iterar sobre la lista de usuarios -->
            @foreach($empresas as $empresa)
            <tr class="user-row">
            <td class="text-center border border-gray-400 px-4 py-2 user-name">
                {{ $empresa->codigo_empresa }}

            </td>
                <td class="text-center border border-gray-400 px-4 py-2 nombre-comercial">{{ $empresa->nombre_comercial }}</td>
                <td class="border border-gray-400 px-4 py-2 flex items-center justify-center">
                    <img src="{{ asset($empresa->logo) }}" alt="Logo de la empresa" class="h-16 w-auto">
                </td>
                    <td class="border border-gray-400 px-4 py-2">
                        <div class="flex justify-center">
                            <form class="mr-2" action="{{ route('empresas.edit', $empresa->id) }}">
                                @csrf
                                <a href="{{ route('empresas.edit', $empresa->id) }}" class="text-blue-500 hover:underline text-bold mr-2">Editar</a>
                            </form>
                            <!-- En lugar de eliminar, inhabilitar/habilitar -->
                            <form id="toggle-form-{{ $empresa->id }}" action="{{ route('empresas.toggle', $empresa->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if ($empresa->active)
                                    <button type="submit" class="text-gray-500 hover:underline text-bold">Inhabilitar</button>
                                    @else
                                    <button type="submit" class="text-green-500 hover:underline text-bold">Habilitar</button>
                                @endif
                            </form>
                        </div>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<!-- Fin Administrar Empresas -->



<!-- Inicio JS para barra de búsqueda -->
<script src="{{ mix('js/app.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();

            const empresas = document.querySelectorAll('.user-row');

            empresas.forEach(function(empresa) {
                const nombreComercial = empresa.querySelector('.nombre-comercial').textContent.trim().toLowerCase();
                
                if (nombreComercial.includes(searchTerm)) {
                    empresa.style.display = 'table-row';
                } else {
                    empresa.style.display = 'none';
                }
            });
        });
    });
</script>
<!-- Fin JS para barra de búsqueda -->


<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->

</body>
</html>