<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Create | Correo y N° cuenta</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('includes.header_redirect_main')
<!-- Fin navegación superior -->

<div class="my-6">
    <h1 class="text-center font-semibold text-2xl">Crear Correo y N° cuenta bancaria para {{ $empresa->razon_social }}</h1>
</div>

<div class="max-w-lg mx-auto bg-white p-4 rounded shadow">
    <form action="{{ route('empresa_detalles.store', $empresa->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="correoFactura" class="block font-medium mb-1">Correo (Comprobante de Pago)</label>
            <input type="email" name="correoFactura" id="correoFactura" class="w-full border p-2 rounded" required placeholder="ejemplo@correo.com">
        </div>
        <div class="mb-4">
            <label for="cuentaBanco" class="block font-medium mb-1">N° de Cuenta Bancaria (Banco, Tipo y N°)</label>
            <input type="text" name="cuentaBanco" id="cuentaBanco" class="w-full border p-2 rounded" required placeholder="Número de cuenta">
        </div>
        <div class="text-center">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
            <a href="{{ route('empresa_detalles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancelar</a>
        </div>
    </form>
</div>

<!-- Inicio Footer -->
@include('includes.footer')
<!-- Cierre Footer -->
    
</body>
</html>
