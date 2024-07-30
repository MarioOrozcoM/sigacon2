<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Administrar Copropiedades</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<!-- Inicio rol -->
@include('includes.show_rol')
<!-- Fin rol -->

<div class="text-center">
    <h1 class="text-bold text-2xl text-black">Administrar Copropiedades</h1>
</div>
    

<!-- Inicio Administrar Copropiedades -->
<div class="container mx-auto px-4 mt-8">
    <h2 class="text-xl font-semibold">Lista de Copropiedades</h2>
    <!-- Barra de búsqueda -->
    <div class="mt-4">
        <input type="text" id="searchInput" placeholder="Buscar por nombre" class="border border-gray-400 px-4 py-2 mb-4 mr-6">
        <!-- Agregar Copropiedad -->
        <a href="{{ route('copropiedades.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Agregar Copropiedad</a>
    </div>

    <!-- Lista de Copropiedades -->
    <table class="w-full border-collapse border border-gray-400">
        <thead>
            <tr class="uppercase">
                <th class="border border-gray-400 px-4 py-2 w-1/6">Nit Copropiedad</th>
                <th class="border border-gray-400 px-4 py-2 w-1/3">Nombre Copropiedad</th>
                <th class="border border-gray-400 px-4 py-2 w-1/4">Logotipo</th>
                <th class="border border-gray-400 px-4 py-2 w-1/12">Acciones</th>
            </t
        </thead>
        <tbody>
            <!-- Iterar sobre la lista de copropiedades -->
            @foreach($copropiedades as $copropiedad)
            <tr class="user-row">
            <td class="text-center border border-gray-400 px-4 py-2 user-name">
                {{ $copropiedad->nit_copropiedad }}

            </td>
                <td class="text-center border border-gray-400 px-4 py-2 nombre-copropiedad">{{ $copropiedad->nombre_copropiedad }}</td>
                <td class="border border-gray-400 px-4 py-2 flex items-center justify-center">
                    <img src="{{ asset($copropiedad->logo) }}" alt="Logo de la copropiedad" class="h-16 w-auto">
                </td>
                    <td class="border border-gray-400 px-4 py-2">
                        <div class="flex justify-center">
                            <form class="mr-2" action="{{ route('copropiedades.edit', $copropiedad->id) }}">
                                @csrf
                                <a href="{{ route('copropiedades.edit', $copropiedad->id) }}" class="text-blue-500 hover:underline text-bold mr-2">Editar</a>
                            </form>
                            <!-- En lugar de eliminar, inhabilitar/habilitar -->
                            <form id="toggle-form-{{ $copropiedad->id }}" action="{{ route('copropiedades.toggle', $copropiedad->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if ($copropiedad->active)
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
<!-- Fin Administrar Copropiedades -->


<!-- Inicio JS para barra de búsqueda -->
<script src="{{ mix('js/app.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();

            const copropiedades = document.querySelectorAll('.user-row');

            copropiedades.forEach(function(copropiedad) {
                const nombreCopropiedad = copropiedad.querySelector('.nombre-copropiedad').textContent.trim().toLowerCase();
                
                if (nombreCopropiedad.includes(searchTerm)) {
                    copropiedad.style.display = 'table-row';
                } else {
                    copropiedad.style.display = 'none';
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