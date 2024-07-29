<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Contacto</title>
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

<div class="text-black text-center mt-4">
  <h1 class=" text-2xl font-bold">CONTACTO</h1>
    <p class="text-lg font-semibold mt-6">Ingrese al primer link para enviar un mensaje al correo ó el segundo link para ingresar al chat de whatsapp.
      En ambos casos un asesor se comunicará con usted.
    </p>
</div>
<!-- Inicio formulario Contacto -->
<!-- <div class="flex justify-center items-center h-full my-8 mt-8"> -->
  <!-- <div class="bg-white p-8 rounded-lg shadow-lg overflow-y-auto max-h-full"> -->
    <!-- <h2 class="text-2xl font-semibold mb-4">Formulario de Contacto</h2> -->
    <!-- <form id="contactForm" action="https://formsubmit.co/el/worevo" method="POST"> -->
      <!-- <div class="mb-4"> -->
        <!-- <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label> -->
        <!-- <input type="text" id="name" name="name" class="form-input mt-1 block w-full border border-gray-300 rounded-md" required> -->
      <!-- </div> -->
      <!-- <div class="mb-4"> -->
        <!-- <label for="phone" class="block text-sm font-medium text-gray-700">Número de Contacto</label> -->
        <!-- <input type="text" id="phone" name="phone" class="form-input mt-1 block w-full border border-gray-300 rounded-md" required> -->
      <!-- </div> -->
      <!-- <div class="mb-4"> -->
        <!-- <label for="email" class="block text-sm font-medium text-gray-700">Email</label> -->
        <!-- <input type="email" id="email" name="email" class="form-input mt-1 block w-full border border-gray-300 rounded-md" required> -->
      <!-- </div> -->
      <!-- <div class="mb-4"> -->
        <!-- <label for="message" class="block text-sm font-medium text-gray-700">Mensaje</label> -->
        <!-- <textarea id="message" name="message" class="form-textarea mt-1 block w-full border border-gray-300 rounded-md" rows="4" required></textarea> -->
      <!-- </div> -->
      <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Enviar</button> -->
      <!-- <input type="submit" value="Enviar" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"> -->
      <!-- <input type="hidden" name="_next" value="http://127.0.0.1:8000/">
      <input type="hidden" name="_captcha" value="false"> -->
    <!-- </form>
  </div>
</div> -->
<!-- Cierre formulario Contacto -->
 <!-- Inicio botón para abrir formsubmit -->
<div class="flex justify-center mt-16">
    <a href="https://formsubmit.co/el/worevo" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Mensaje al correo</a>
</div>
 <!-- Fin botón para abrir formsubmit -->
<!-- Inicio Botón para abrir el chat de WhatsApp -->
<div class="flex justify-center mt-16">
    <a href="https://wa.me/573002182505?text=Hola,%20estoy%20interesad@%20en%20tus%20servicios" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Chat de WhatsApp</a>
</div>
<!-- Fin Botón para abrir el chat de WhatsApp -->

<!-- Inicio Validar formulario contacto -->
<!-- <script>
  function validateForm() {
    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;

    if (name === '' || phone === '' || email === '' || message === '') {
      alert('Por favor, llene todos los campos.');
      return false;
    }

    return true;
  }
</script> -->
<!-- CIerre Validar formulario contacto -->


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