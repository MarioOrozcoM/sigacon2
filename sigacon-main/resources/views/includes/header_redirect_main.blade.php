<header class="bg-black">
    <div class="container mx-auto flex items-center justify-between px-4 py-2 text-white">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-60">
        
        <div class="flex space-x-4 text-white text-lg">
            <a href="{{ url('/main') }}" class="hover:text-gray-400">INICIO</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:text-gray-400">CERRAR SESIÓN</button>
            </form>
        </div>
    </div>
</header>

<!-- 
    Éste include es para agilizar la creación del header (navegación superior) para regresar al inicio
    del main, dónde se encuentran las acciones disponibles.
 -->