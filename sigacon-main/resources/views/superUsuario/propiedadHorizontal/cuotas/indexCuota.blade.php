<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Admin | Cuotas PH</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('includes.header_redirect_main') <!-- HEADER -->
    <!-- Fin navegación superior -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black">Administrar Cuotas de Propiedad Horizontal</h1>
    </div>

    <div class="max-w-4xl mx-auto px-4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('cuotasPH.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Nueva Cuota</a>
        </div>
        
        <table class="table-auto w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Concepto</th>
                    <th class="px-4 py-2">Valor Individual</th>
                    <th class="px-4 py-2">Empresa</th>
                    <th class="px-4 py-2">Número de Unidades</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuotasPH as $cuota)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $cuota->concepto->nombreConcepto }}</td>
                        <td class="px-4 py-2">$ {{ $cuota->vrlIndividual }}</td>
                        <td>
            @if ($cuota->unidades->isNotEmpty())
                @php
                    $empresasMostradas = []; // Conjunto para almacenar las empresas mostradas
                @endphp
                @foreach ($cuota->unidades as $unidad)
                    @if (!in_array($unidad->empresa->id, $empresasMostradas))
                        <span>{{ $unidad->empresa->razon_social }}</span><br>
                        @php
                            $empresasMostradas[] = $unidad->empresa->id; // Agrega la empresa al conjunto
                        @endphp
                    @endif
                @endforeach
            @else
                Sin Empresa
            @endif
        </td>
                        <td class="px-4 py-2 text-center">{{ $cuota->unidades->count() }}</td> <!-- Número de unidades que tienen la cuota -->
                        <td class="px-4 py-2 flex justify-around gap-4">
                            <a href="{{ route('cuotasPH.edit', $cuota) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-4 rounded">Editar</a>
                            <form action="{{ route('cuotasPH.destroy', $cuota) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta cuota?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->
    
</body>
</html>