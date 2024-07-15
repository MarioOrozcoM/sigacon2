<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Admin Users</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->
<div class="top-left-info ml-8 mt-4 text-lg text-semibold">
        <p>{{ $user->rol }}</p>
</div>
<div class="text-center">
    <h1 class="text-bold text-2xl text-black">Administrar Usuarios</h1>
</div>


<!-- Inicio administrar usuarios -->
<div class="container mx-auto px-4 mt-8">
    <h2 class="text-xl font-semibold">Lista de Usuarios</h2>
    
    <!-- Barra de búsqueda -->
    <div class="mt-4">
    <input type="text" id="searchInput" placeholder="Buscar por nombre" class="border border-gray-400 px-4 py-2 mb-4 mr-6">
    <!-- Agregar Usuario -->
    <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Agregar Usuario</a>
    </div>
    
    <!-- Lista de usuarios -->
    <table class="w-full border-collapse border border-gray-400">
        <thead>
            <tr class="uppercase">
                <th class="border border-gray-400 px-4 py-2">Nombre</th>
                <th class="border border-gray-400 px-4 py-2">Email</th>
                <th class="border border-gray-400 px-4 py-2">Rol</th>
                <th class="border border-gray-400 px-4 py-2 w-40">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterar sobre la lista de usuarios -->
            @foreach($users as $user)
            <tr class="user-row">
            <td class="border border-gray-400 px-4 py-2 user-name">
                {{ $user->first_name }} {{ $user->second_name ? $user->second_name : '' }} 
                {{ $user->first_lastname }} {{ $user->second_lastname ? $user->second_lastname : '' }}
            </td>
                <td class="border border-gray-400 px-4 py-2">{{ $user->email }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $user->rol }}</td>
                <td class="border border-gray-400 px-4 py-2 flex items-center">
                    <form class="mr-2" action="{{ route('users.edit', $user->id) }}">
                        @csrf
                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline text-bold mr-2">Editar</a>
                    </form>
                    <!-- En lugar de eliminar, inhabilitar/habilitar -->
                    @if ($user->rol !== 'superUsuario')
                        <form id="toggle-form-{{ $user->id }}" action="{{ route('users.toggle', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if ($user->active)
                                <button type="submit" class="text-gray-500 hover:underline text-bold">Inhabilitar</button>
                            @else
                                <button type="submit" class="text-green-500 hover:underline text-bold">Habilitar</button>
                            @endif
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
<!-- Fin administrar usuarios -->



<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->

<!-- JavaScript para barra de búsqueda -->
<script src="{{ mix('js/app.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();

            const users = document.querySelectorAll('.user-row');

            users.forEach(function(user) {
                const name = user.querySelector('.user-name').textContent.trim().toLowerCase();
                
                if (name.includes(searchTerm)) {
                    user.style.display = 'table-row';
                } else {
                    user.style.display = 'none';
                }
            });
        });
    });
</script>

</body>
</html>
