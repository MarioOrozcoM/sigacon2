<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Admin | Empresas: Correo y Cuenta</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('includes.header_redirect_main')
<!-- Fin navegación superior -->

<div class="my-6">
    <h1 class="text-center font-semibold text-2xl">Administrar Correo de comprobante y N° cuenta bancaria de cada empresa</h1>
</div>

<div class="max-w-4xl mx-auto mt-8">
<!-- Selector de Empresa -->
<form action="{{ route('empresa_detalles.index') }}" method="GET" class="flex justify-center mb-4 gap-4">
    <label for="empresa_id" class="self-center">Seleccione una Empresa:</label>
    <select name="empresa_id" id="empresa_id" class="border p-2">
        <option value="">Seleccione una empresa</option>
        @foreach ($empresas as $empresa)
            <option value="{{ $empresa->id }}" {{ request('empresa_id') == $empresa->id ? 'selected' : '' }}>
                {{ $empresa->razon_social }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mostrar Detalles</button>
</form>
<!-- ... -->
@if(request('empresa_id'))
    <div class="max-w-4xl mx-auto mt-4 bg-white p-4 rounded shadow">
        @php
            $empresaSeleccionada = $empresas->find(request('empresa_id'));
            $detalles = $empresaSeleccionada->detalles; // Asegúrate de tener esta relación en tu modelo
        @endphp

        <h2 class="text-xl font-semibold mb-4">Empresa: {{ $empresaSeleccionada->razon_social }}</h2>

        @if ($detalles)
            <p><strong>Correo de Factura:</strong> {{ $detalles->correoFactura }}</p>
            <p><strong>N° de Cuenta Bancaria:</strong> {{ $detalles->cuentaBanco }}</p>
            <div class="mt-4">
                <a href="{{ route('empresa_detalles.edit', $detalles->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                <form action="{{ route('empresa_detalles.destroy', $detalles->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar estos detalles?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                </form>
            </div>
        @else
            <p class="mb-4">No se han registrado detalles para esta empresa.</p>
            <a href="{{ route('empresa_detalles.create', request('empresa_id')) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Crear Detalles</a>
        @endif
    </div>
@endif
</div>

<!-- Inicio Footer -->
@include('includes.footer')
<!-- Cierre Footer -->

</body>
</html>
