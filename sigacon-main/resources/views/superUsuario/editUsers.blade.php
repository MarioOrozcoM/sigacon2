<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Agregar Usuario</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio navegación superior -->
@include('superUsuario.headerSuper') <!-- HEADER --> 
<!-- Fin navegación superior -->

<h2 class="text-xl font-semibold text-center mt-4">Agregar Nuevo Usuario</h2>

<!-- Inicio formulario para agregar usuario -->
<div class="container mx-auto px-4 mt-8 mb-6 grid grid-cols-2 gap-4">
    <div>
        <h2 class="text-xl font-semibold mb-4">Datos Generales:</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="document_type" class="block text-gray-700 text-sm font-bold mb-2">Documento Identificación:</label>
                <select name="document_type" id="document_type" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($document_types as $document_type)
                        <option value="{{ $document_type }}">{{ $document_type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="identification_number" class="block text-gray-700 text-sm font-bold mb-2">Número Documento Identificación:</label>
                <input type="text" id="identification_number" name="identification_number" value="{{ old('identification_number') }}"  class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">Primer Nombre:</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" autocomplete="given-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="second_name" class="block text-gray-700 text-sm font-bold mb-2">Segundo Nombre:</label>
                <input type="text" id="second_name" name="second_name" value="{{ old('second_name') }}" autocomplete="additional-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="first_lastname" class="block text-gray-700 text-sm font-bold mb-2">Primer Apellido:</label>
                <input type="text" id="first_lastname" name="first_lastname" value="{{ old('first_lastname') }}" autocomplete="family-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="second_lastname" class="block text-gray-700 text-sm font-bold mb-2">Segundo Apellido:</label>
                <input type="text" id="second_lastname" name="second_lastname" value="{{ old('second_lastname') }}" autocomplete="additional-name" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="rol" class="block text-gray-700 text-sm font-bold mb-2">Rol:</label>
                <select name="rol" id="rol" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($roles as $rol)
                        <option value="{{ $rol }}">{{ $rol }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="social_reason" class="block text-gray-700 text-sm font-bold mb-2">Razón Social:</label>
                <input type="text" id="social_reason" name="social_reason" value="{{ old('social_reason') }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="trade_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre Comercial:</label>
                <input type="text" id="trade_name" name="trade_name" value="{{ old('trade_name') }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="physical_address" class="block text-gray-700 text-sm font-bold mb-2">Dirección Física:</label>
                <input type="text" id="physical_address" name="physical_address" value="{{ old('physical_address') }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono Fijo:</label>
                <input type="number" id="phone" name="phone" value="{{ old('phone') }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="cellphone" class="block text-gray-700 text-sm font-bold mb-2">Celular:</label>
                <input type="number" id="cellphone" name="cellphone" value="{{ old('cellphone') }}" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="country_id" class="block text-gray-700 text-sm font-bold mb-2">País:</label>
                <select name="country_id" id="country_id" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="state_id" class="block text-gray-700 text-sm font-bold mb-2">Estado/Departamento:</label>
                <select name="state_id" id="state_id" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="city_id" class="block text-gray-700 text-sm font-bold mb-2">Ciudad:</label>
                <select name="city_id" id="city_id" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                <input type="password" id="password" name="password" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="border border-gray-400 rounded-md py-2 px-3 w-full">
            </div>
    </div>
            <div>
                <h2 class="text-xl font-semibold mb-4">Datos Fiscales (Opcionales):</h2>
                <div class="mb-4">
                    <label for="autoretenedor_renta" class="block text-gray-700 text-sm font-bold mb-2">AutoRetenedor Renta:</label>
                    <select name="autoretenedor_renta" id="autoretenedor_renta" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($autoretenedor_rentas as $autoretenedor_renta)
                            <option value="{{ $autoretenedor_renta }}">{{ $autoretenedor_renta }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="autoretenedor_iva" class="block text-gray-700 text-sm font-bold mb-2">AutoRetenedor Iva:</label>
                    <select name="autoretenedor_iva" id="autoretenedor_iva" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($autoretenedor_ivas as $autoretenedor_iva)
                            <option value="{{ $autoretenedor_iva }}">{{ $autoretenedor_iva }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="autoretenedor_ica" class="block text-gray-700 text-sm font-bold mb-2">AutoRetenedor Ica:</label>
                    <select name="autoretenedor_ica" id="autoretenedor_ica" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($autoretenedor_icas as $autoretenedor_ica)
                            <option value="{{ $autoretenedor_ica }}">{{ $autoretenedor_ica }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="responsable_iva" class="block text-gray-700 text-sm font-bold mb-2">Responsable de Iva:</label>
                    <select name="responsable_iva" id="responsable_iva" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($responsable_ivas as $responsable_iva)
                            <option value="{{ $responsable_iva }}">{{ $responsable_iva }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="declarante_rsts" class="block text-gray-700 text-sm font-bold mb-2">Declarante de RSTS:</label>
                    <select name="declarante_rsts" id="declarante_rsts" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($declarante_rstss as $declarante_rsts)
                            <option value="{{ $declarante_rsts }}">{{ $declarante_rsts }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="declarante_renta" class="block text-gray-700 text-sm font-bold mb-2">Declarante de Renta:</label>
                    <select name="declarante_renta" id="declarante_renta" class="border border-gray-400 rounded-md py-2 px-3 w-full">
                        @foreach($declarante_rentas as $declarante_renta)
                            <option value="{{ $declarante_renta }}">{{ $declarante_renta }}</option>
                        @endforeach
                    </select>
                </div>
                            <!-- Botón para crear el usuario -->
            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Usuario</button>
            </div>
            </div>

        </form>

</div>

<!-- Fin formulario para agregar usuario -->


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
