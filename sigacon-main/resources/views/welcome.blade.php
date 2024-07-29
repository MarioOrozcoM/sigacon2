<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>SIGACON</title>
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
            <a href="{{ url('/inicio_sesion') }}" class="hover:text-gray-400">INICIAR SESION</a>
        </div>

    </div>
</header> <!-- Cierre navegación superior -->

<!-- Inicio área publicidad -->
<div class="bg-gray-300 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-center font-bold text-2xl">Home Page</h1>
        <div class="grid grid-cols-3 gap-4">
            
            <div class="col-span-1">
                <!-- Contenido de la primera columna -->
            </div>
            <div class="col-span-1">
                <!-- Contenido de la segunda columna -->
            </div>
            <div class="col-span-1">
                <!-- Contenido de la tercera columna -->
            </div>
        </div>
    </div>
</div>
<!-- Cierre área publicidad -->

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
