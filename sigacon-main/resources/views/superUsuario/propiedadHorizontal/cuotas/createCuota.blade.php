<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <title>Create | CuotaPH</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('includes.header_redirect_main') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black mb-12">Crear Cuota</h1>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('cuotasPH.store') }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf

            <!-- Selección del Concepto -->
            <div class="col-span-2 md:col-span-1">
                <label for="concepto_id" class="block text-sm font-medium text-gray-700">Concepto</label>
                <select name="concepto_id" id="concepto_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
                    <option value="">Selecciona Una Opción</option>
                    @foreach($conceptos as $concepto)
                        <option value="{{ $concepto->id }}">{{ $concepto->nombreConcepto }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Valor Individual -->
            <div class="col-span-2 md:col-span-1">
                <label for="vrlIndividual" class="block text-sm font-medium text-gray-700">Valor Individual</label>
                <input type="number" name="vrlIndividual" id="vrlIndividual" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-text">
            </div>

            <!-- Tipo -->
            <div class="col-span-2 md:col-span-1">
                <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
                <select name="tipo" id="tipo" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
                    <option value="">Selecciona Una Opción</option>
                    <option value="Constante">Constante</option>
                    <option value="Novedad">Novedad</option>
                </select>
            </div>

            <!-- A nombre de -->
            <div class="col-span-2 md:col-span-1">
                <label for="aNombreDe" class="block text-sm font-medium text-gray-700">A nombre de</label>
                <input type="text" name="aNombreDe" id="aNombreDe" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-text">
            </div>

            <!-- Desde -->
            <div class="col-span-2 md:col-span-1">
                <label for="desde" class="block text-sm font-medium text-gray-700">Desde</label>
                <input type="date" name="desde" id="desde" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
            </div>

            <!-- Hasta -->
            <div class="col-span-2 md:col-span-1">
                <label for="hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
                <input type="date" name="hasta" id="hasta" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
            </div>

            <!-- Selección de la Empresa -->
            <div class="col-span-2 md:col-span-1">
                <label for="empresa_id" class="block text-sm font-medium text-gray-700">Empresa de Propiedad Horizontal</label>
                <select name="empresa_id" id="empresa_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
                    <option value="">Selecciona Una Opción</option>
                    @foreach($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->razon_social }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Selección de Unidades -->
            <div class="col-span-2 md:col-span-1">
                <label for="unidad_ids" class="block text-sm font-medium text-gray-700">Unidades</label>
                <select name="unidad_ids[]" id="unidad_ids" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-pointer">
                    <option value="">Selecciona Una Opción</option>
                    <option value="all">Seleccionar Todas</option> <!-- Opción para seleccionar todas las unidades -->
                </select>
            </div>




            <!-- Observación -->
            <div class="col-span-2">
                <label for="observacion" class="block text-sm font-medium text-gray-700">Observación</label>
                <textarea name="observacion" id="observacion" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 cursor-text"></textarea>
            </div>

            <!-- Botón Guardar -->
            <div class="col-span-2 flex justify-center mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-8">
                    Guardar Cuota
                </button>
            </div>

        </form>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#unidad_ids').select2({
                placeholder: "Selecciona Una Opción",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
        $('#unidad_ids').select2({
            placeholder: "Selecciona Una Opción",
            allowClear: true
        });

        // Al cambiar la empresa, carga las unidades correspondientes
        $('#empresa_id').on('change', function() {
            const empresaId = $(this).val();

            // Limpia las unidades previamente seleccionadas
            $('#unidad_ids').empty();

            // Agrega la opción "Selecciona Una Opción"
            // $('#unidad_ids').append(new Option("Selecciona Una Opción", "", true, true));
            $('#unidad_ids').append(new Option("Seleccionar Todas", "all"));

            if (empresaId) {
                $.ajax({
                    url: `/empresas/${empresaId}/unidades`,
                    method: 'GET',
                    success: function(data) {
                        // Agrega las unidades al select
                        data.forEach(function(unidad) {
                            $('#unidad_ids').append(new Option(`${unidad.tipoUnidad} - ${unidad.number}`, unidad.id));
                        });

                        // Reinicia la selección para evitar que se muestre un valor vacío
                        $('#unidad_ids').val(null).trigger('change'); // Reinicia Select2
                    },
                    error: function() {
                        alert('Error al cargar las unidades');
                    }
                });
            } else {
                // Si no hay empresa seleccionada, resetea el select
                $('#unidad_ids').empty().append(new Option("Selecciona Una Opción", "", true, true));
                $('#unidad_ids').append(new Option("Seleccionar Todas", "all"));
                $('#unidad_ids').val(null).trigger('change'); // Reinicia Select2
            }
        });
    });

    </script>

</body>
</html>
