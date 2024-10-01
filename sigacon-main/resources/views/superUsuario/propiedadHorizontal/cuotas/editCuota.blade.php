<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <title>Edit | CuotaPH</title>
</head>
<body class="flex flex-col min-h-screen">
    
    <!-- Inicio navegación superior -->
    @include('includes.header_redirect_main') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black mb-12">Editar Cuota - {{ $empresa->razon_social }}</h1>
    </div>

    <div class="container mx-auto px-4">
        <form action="{{ route('cuotasPH.update', $cuota->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Necesario para enviar PUT request -->

            <!-- Empresa asociada (campo oculto) -->
            <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">

            <!-- Selección de concepto -->
            <div class="mb-6">
                <label for="concepto_id" class="block text-gray-700">Concepto</label>
                <select name="concepto_id" id="concepto_id" class="select2 w-full">
                    @foreach($conceptos as $concepto)
                        <option value="{{ $concepto->id }}" {{ $cuota->concepto_id == $concepto->id ? 'selected' : '' }}>
                            {{ $concepto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Valor individual -->
            <div class="mb-6">
                <label for="vrlIndividual" class="block text-gray-700">Valor Individual</label>
                <input type="text" name="vrlIndividual" id="vrlIndividual" value="{{ old('vrlIndividual', $cuota->vrlIndividual) }}" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Tipo de cuota -->
            <div class="mb-6">
                <label for="tipo" class="block text-gray-700">Tipo de Cuota</label>
                <input type="text" name="tipo" id="tipo" value="{{ old('tipo', $cuota->tipo) }}" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- A Nombre De -->
            <div class="mb-6">
                <label for="aNombreDe" class="block text-gray-700">A Nombre De</label>
                <input type="text" name="aNombreDe" id="aNombreDe" value="{{ old('aNombreDe', $cuota->aNombreDe) }}" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Fechas -->
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="desde" class="block text-gray-700">Desde</label>
                    <input type="date" name="desde" id="desde" value="{{ old('desde', $cuota->desde) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="hasta" class="block text-gray-700">Hasta</label>
                    <input type="date" name="hasta" id="hasta" value="{{ old('hasta', $cuota->hasta) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <!-- Selección de Unidades -->
            <div class="mb-6">
                <label for="unidad_ids" class="block text-gray-700">Seleccionar Unidades</label>
                <select name="unidad_ids[]" id="unidad_ids" class="select2 w-full" multiple>
                    <option value="all">Seleccionar Todas</option>
                    @foreach($unidades as $unidad)
                        <option value="{{ $unidad->id }}" {{ in_array($unidad->id, $cuota->unidades->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $unidad->tipoUnidad }} - {{ $unidad->number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Observación -->
            <div class="mb-6">
                <label for="observacion" class="block text-gray-700">Observación</label>
                <textarea name="observacion" id="observacion" class="w-full border-gray-300 rounded-md shadow-sm">{{ old('observacion', $cuota->observacion) }}</textarea>
            </div>

            <!-- Botón para actualizar -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Actualizar Cuota</button>
            </div>
        </form>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
</body>
</html>
