<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Editar Usuario Info</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<!-- Inicio formulario editar info usuario -->
<div class="container mx-auto px-4 mt-8 mb-6 grid grid-cols-2 gap-4">
    <div>
    <h2 class="text-xl font-bold mb-4 text-center">Editar Usuario</h2>
    <h2 class="text-xl font-semibold mb-4">Datos Generales:</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="document_type" class="block text-gray-700 text-sm font-bold mb-2">Documento Identificación:</label>
            <select name="document_type" id="document_type" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($document_types as $document_type)
                    <option value="{{ $document_type }}" @if($user->document_type == $document_type) selected @endif>{{ $document_type }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
        <input type="hidden" name="identification_number" value="{{ $user->identification_number }}">
        </div>
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">Primer Nombre:</label>
            <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" autocomplete="given-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="second_name" class="block text-gray-700 text-sm font-bold mb-2">Segundo Nombre:</label>
            <input type="text" id="second_name" name="second_name" value="{{ $user->second_name }}" autocomplete="additional-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="first_lastname" class="block text-gray-700 text-sm font-bold mb-2">Primer Apellido:</label>
            <input type="text" id="first_lastname" name="first_lastname" value="{{ $user->first_lastname }}" autocomplete="family-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="second_lastname" class="block text-gray-700 text-sm font-bold mb-2">Segundo Apellido:</label>
            <input type="text" id="second_lastname" name="second_lastname" value="{{ $user->second_lastname }}" autocomplete="additional-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="rol" class="block text-gray-700 text-sm font-bold mb-2">Rol:</label>
            <select name="rol" id="rol" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($roles as $rol)
                    <option value="{{ $rol }}" @if($user->rol == $rol) selected @endif>{{ $rol }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="social_reason" class="block text-gray-700 text-sm font-bold mb-2">Razón Social:</label>
            <input type="text" id="social_reason" name="social_reason" value="{{ $user->social_reason }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="trade_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre Comercial:</label>
            <input type="text" id="trade_name" name="trade_name" value="{{ $user->trade_name }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="physical_address" class="block text-gray-700 text-sm font-bold mb-2">Dirección Física:</label>
            <input type="text" id="physical_address" name="physical_address" value="{{ $user->physical_address }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" autocomplete="email" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono Fijo:</label>
            <input type="number" id="phone" name="phone" value="{{ $user->phone }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="cellphone" class="block text-gray-700 text-sm font-bold mb-2">Celular:</label>
            <input type="number" id="cellphone" name="cellphone" value="{{ $user->cellphone }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
        </div>
        <div class="mb-4">
            <label for="country_id" class="block text-gray-700 text-sm font-bold mb-2">País:</label>
            <select name="country_id" id="country_id" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" @if($user->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="state_id" class="block text-gray-700 text-sm font-bold mb-2">Estado/Departamento:</label>
            <select name="state_id" id="state_id" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($states as $state)
                    <option value="{{ $state->id }}" @if($user->state_id == $state->id) selected @endif>{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="city_id" class="block text-gray-700 text-sm font-bold mb-2">Ciudad:</label>
            <select name="city_id" id="city_id" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" @if($user->city_id == $city->id) selected @endif>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div>
        <div class="mb-11"></div>
        <h2 class="text-xl font-semibold mb-4">Datos Fiscales:</h2>
        <div class="mb-4">
            <label for="autoretenedor_renta" class="block text-gray-700 text-sm font-bold mb-2">AutoRetenedor Renta:</label>
            <select name="autoretenedor_renta" id="autoretenedor_renta" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($autoretenedor_rentas as $autoretenedor_renta)
                    <option value="{{ $autoretenedor_renta }}" @if($user->autoretenedor_renta == $autoretenedor_renta) selected @endif>{{ $autoretenedor_renta }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="autoretenedor_iva" class="block text-gray-700 text-sm font-bold mb-2">AutoRetenedor Iva:</label>
            <select name="autoretenedor_iva" id="autoretenedor_iva" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($autoretenedor_ivas as $autoretenedor_iva)
                    <option value="{{ $autoretenedor_iva }}" @if($user->autoretenedor_iva == $autoretenedor_iva) selected @endif>{{ $autoretenedor_iva }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="autoretenedor_ica" class="block text-gray-700 text-sm font-bold mb-2">AutoRetenedor Ica:</label>
            <select name="autoretenedor_ica" id="autoretenedor_ica" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($autoretenedor_icas as $autoretenedor_ica)
                    <option value="{{ $autoretenedor_ica }}" @if($user->autoretenedor_ica == $autoretenedor_ica) selected @endif>{{ $autoretenedor_ica }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="responsable_iva" class="block text-gray-700 text-sm font-bold mb-2">Responsable de Iva:</label>
            <select name="responsable_iva" id="responsable_iva" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($responsable_ivas as $responsable_iva)
                    <option value="{{ $responsable_iva }}" @if($user->responsable_iva == $responsable_iva) selected @endif>{{ $responsable_iva }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="declarante_rsts" class="block text-gray-700 text-sm font-bold mb-2">Declarante de RSTS:</label>
            <select name="declarante_rsts" id="declarante_rsts" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($declarante_rstss as $declarante_rsts)
                    <option value="{{ $declarante_rsts }}" @if($user->declarante_rsts == $declarante_rsts) selected @endif>{{ $declarante_rsts }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="declarante_renta" class="block text-gray-700 text-sm font-bold mb-2">Declarante de Renta:</label>
            <select name="declarante_renta" id="declarante_renta" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                @foreach($declarante_rentas as $declarante_renta)
                    <option value="{{ $declarante_renta }}" @if($user->declarante_renta == $declarante_renta) selected @endif>{{ $declarante_renta }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <!-- Botón para actualizar los datos -->
        <div class="mt-8">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar Usuario</button>
        </div>
    </form>
    <!-- Enlace para descargar el archivo Excel -->
    <div class="text-center mt-4">
        <a href="{{ route('download.excel', ['userId' => $user->id]) }}" class="bg-green-300 hover:bg-green-400 text-black font-bold py-2 px-4 rounded">Descargar Excel</a>
    </div>
</div>
<!-- Fin formulario editar info usuario -->


<!-- js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#country_id').change(function() {
        var country_id = $(this).val();
        if (country_id) {
            $.ajax({
                type: 'GET',
                url: '/get-states/' + country_id,
                success: function(states) {
                    $('#state_id').empty();
                    $.each(states, function(key, value) {
                        $('#state_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('#state_id').empty();
        }
    });
    $('#state_id').change(function() {
            var state_id = $(this).val();
            if (state_id) {
                $.ajax({
                    type: 'GET',
                    url: '/get-cities/' + state_id,
                    success: function(cities) {
                        $('#city_id').empty();
                        $.each(cities, function(key, value) {
                            $('#city_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#city_id').empty();
            }
        });
    });
</script>
<!-- js -->


<!-- Inicio footer -->
@include('includes.footer')
<!-- Fin footer -->

</body>
</html>