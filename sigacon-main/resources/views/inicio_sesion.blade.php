<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Iniciar Sesion</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
<header class="bg-black">

    <div class="container mx-auto flex items-center justify-between px-4 py-2 text-white">
        <a href=".">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-60">
        </a>
        <div class="flex space-x-4 text-white">
            <a href="{{ url('/nosotros') }}" class="hover:text-gray-400">NOSOTROS</a>
            <a href="#" class="hover:text-gray-400">MARKETPLACE</a>
            <a href="{{ url('/contacto') }}" class="hover:text-gray-400">CONTACTO</a>
            <!-- <a href="{{ url('/inicio_sesion') }}" class="hover:text-gray-400">INICIAR SESION</a> -->
        </div>

    </div>
</header> <!-- Cierre navegación superior -->


<!-- Inicio formulario iniciar sesión -->
<div class="container mx-auto px-4 mt-8">
    <div class="max-w-md mx-auto border border-gray-300 rounded-md p-6">
        <h2 class="text-2xl font-bold mb-4">Iniciar Sesión</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="text" id="email" name="email" class="form-input mt-1 block w-full border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Contraseña</label>
                <input type="password" id="password" name="password" class="form-input mt-1 block w-full border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Iniciar Sesión</button>
            </div>
        </form>
    </div>
</div>
<!-- CIerre formulario iniciar sesión -->


<!-- Inicio Footer -->
<footer class="bg-black text-white py-4 mt-auto">
    <div class="container mx-auto px-4">
        <div>
            <div>
                <a href="{{ url('/nosotros') }}" class="mr-4 text-white hover:text-gray-400">NOSOTROS</a>
                <a href="{{ url('/contacto') }}" class="text-white hover:text-gray-400">CONTACTO</a>
            </div>
            <div class="text-white text-lg text-center">
                <p>Todos los Derechos Reservados {{ date('Y') }} &copy;</p>
            </div>
        </div>
    </div>
</footer>
<!-- Cierre Footer -->
    
</body>
</html>