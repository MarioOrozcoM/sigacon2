<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    
<header class="bg-black">
    <div class="container mx-auto flex items-center justify-between px-4 py-2 text-white">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-60">
        
        <div class="flex space-x-4 text-white text-lg">
            <a href="{{ url('/main') }}" class="hover:text-gray-400">INICIO</a>
            <a href="{{ url('/admin/users') }}" class="hover:text-gray-400">USUARIOS</a>
            <a href="{{ url('/empresas') }}" class="hover:text-gray-400">EMPRESAS</a>
            <a href="{{ url('/copropiedades') }}" class="hover:text-gray-400">COPROPIEDADES</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:text-gray-400">CERRAR SESIÓN</button>
            </form>
        </div>
    </div>
</header>


</body>
</html>