<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Nosotros</title>
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


<div> <!-- Inicio Área Nosotros -->
    <h1 class="text-center text-2xl font-bold mt-4">NOSOTROS</h1>
    <p class="text-gray-600 m-6 text-xl">
    <span class="text-orange-500 font-bold">SIGACON</span> es una empresa orientada a desarrollar y comercializar
    su plataforma, la cual permite a los usuarios obtener información ágil, segura y oportuna, 
    administrando de manera sencilla, práctica, y eficaz los datos de su empresa en el menor tiempo
    posible a traves de la plataforma.
    </p>
</div> <!-- Cierre Área Nosotros -->

<!-- Inicio Misión y Visión -->
<div class="grid grid-cols-2 gap-4 mx-6"> 
    <div class="bg-gray-600 opacity-60 text-white p-4">
        <h3 class="text-white text-xl font-bold mb-4 text-center">MISIÓN</h3>
        <p class="text-lg">Permitir a los usuarios obtener información ágil, segura y oportuna, administrando 
        de manera sencilla, práctica, y eficaz la información de su empresa en el menor 
        tiempo posible atraves de la plataforma.</p>
    </div>
    <div class="bg-orange-500 text-white p-4">
        <h3 class="text-white text-xl font-bold mb-4 text-center">VISIÓN</h3>
        <p class="text-lg">Asegurar un alto índice de confianza por la calidad de la información,
        logrando su lealtad y fidelidad, que nos permita ampliar nuestros horizontes a nivel nacional, 
        trabajando en equipo.</p>
    </div>   
</div> <!-- Cierre Misión y Visión -->
    
<!-- Inicio Más sobre nosotros -->
<h1 class="text-black font-bold text-center mt-4 text-2xl">Más Sobre Nosotros</h1>

<div class="grid grid-cols-3 gap-4 mx-6 mt-2 my-8">
    <div>
        <h3 class="text-black text-xl font-bold text-center">Empresas Afiliadas</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec nibh id est consectetur posuere eget vel nisl. Interdum et malesuada fames ac ante ipsum primis in faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed sollicitudin tellus. Pellentesque non pulvinar diam, et pulvinar libero. Phasellus venenatis tristique libero ut suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et eleifend sem, eu egestas diam. Nam quis lorem elit. Donec pretium auctor nisl, id iaculis turpis gravida in. Nunc id laoreet odio. Aenean commodo lacus nec lectus interdum, nec mattis purus placerat. Phasellus at velit quis lacus dictum molestie id sit amet diam. Etiam posuere tortor eget justo ultrices, vitae imperdiet sapien mattis. Proin non dui ut ligula porttitor tempus nec ut nunc.</p>
    </div>
    <div>
        <h3 class="text-black text-xl font-bold text-center">Servicios</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec nibh id est consectetur posuere eget vel nisl. Interdum et malesuada fames ac ante ipsum primis in faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed sollicitudin tellus. Pellentesque non pulvinar diam, et pulvinar libero. Phasellus venenatis tristique libero ut suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et eleifend sem, eu egestas diam. Nam quis lorem elit. Donec pretium auctor nisl, id iaculis turpis gravida in. Nunc id laoreet odio. Aenean commodo lacus nec lectus interdum, nec mattis purus placerat. Phasellus at velit quis lacus dictum molestie id sit amet diam. Etiam posuere tortor eget justo ultrices, vitae imperdiet sapien mattis. Proin non dui ut ligula porttitor tempus nec ut nunc.</p>
    </div>
    <div>
        <h3 class="text-black text-xl font-bold text-center">Planes</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nec nibh id est consectetur posuere eget vel nisl. Interdum et malesuada fames ac ante ipsum primis in faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed sollicitudin tellus. Pellentesque non pulvinar diam, et pulvinar libero. Phasellus venenatis tristique libero ut suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et eleifend sem, eu egestas diam. Nam quis lorem elit. Donec pretium auctor nisl, id iaculis turpis gravida in. Nunc id laoreet odio. Aenean commodo lacus nec lectus interdum, nec mattis purus placerat. Phasellus at velit quis lacus dictum molestie id sit amet diam. Etiam posuere tortor eget justo ultrices, vitae imperdiet sapien mattis. Proin non dui ut ligula porttitor tempus nec ut nunc.</p>
    </div>

</div>

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