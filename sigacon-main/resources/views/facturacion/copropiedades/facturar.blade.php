<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Facturación | Copropiedades</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('includes.header_redirect_main')
<!-- Fin navegación superior -->

<div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Generar Factura para Propiedad Horizontal</h1>
</div>

    <!-- Selector de Empresa -->
    <form action="{{ route('facturas.seleccionar') }}" method="GET" class="flex justify-center mb-4">
        <label for="empresa_id" class="mr-2">Selecciona una Empresa:</label>
        <select name="empresa_id" id="empresa_id" class="border p-2">
            <option value="">Seleccione una empresa</option>
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa->id }}" {{ request('empresa_id') == $empresa->id ? 'selected' : '' }}>
                    {{ $empresa->razon_social }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mostrar Cuotas</button>
    </form>
    <!-- Selector de Empresa FIN -->

    <!-- Mostrar Cuotas Asignadas -->
    @if (!empty($cuotas))
        <form action="{{ route('facturas.generar') }}" method="POST">
            @csrf
            <input type="hidden" name="empresa_id" value="{{ request('empresa_id') }}">

            <table class="table-auto w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Seleccionar</th>
                        <th class="px-4 py-2">Concepto</th>
                        <th class="px-4 py-2">Tipo de Cuota</th>
                        <th class="px-4 py-2">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuotas as $cuota)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                <input type="checkbox" name="cuotas[]" value="{{ $cuota->id }}">
                            </td>
                            <td class="px-4 py-2">{{ optional($cuota->concepto)->nombreConcepto ?? 'Sin concepto' }}</td>
                            <td class="px-4 py-2">{{ $cuota->tipo }}</td>
                            <td class="px-4 py-2">{{ number_format($cuota->vrlIndividual, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Botón para generar la factura -->
            <div class="text-center mt-4">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Generar Factura</button>
            </div>
        </form>
    @else
        <p class="text-center">Seleccione una empresa para ver las cuotas asignadas.</p>
    @endif



<!-- Inicio Footer -->
@include('includes.footer')
<!-- Cierre Footer -->
    
</body>
</html>