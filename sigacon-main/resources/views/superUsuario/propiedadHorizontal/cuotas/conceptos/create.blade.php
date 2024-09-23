<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Create | Conceptos</title>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Inicio navegación superior -->
    @include('includes.header_redirect_main') <!-- HEADER --> 
    <!-- Fin navegación superior -->

    <div class="text-center my-6">
        <h1 class="font-bold text-2xl text-black mb-8">Crear Concepto</h1>
    </div>

    <div class="max-w-md mx-auto px-4">
        <form action="{{ route('conceptos.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="nombreConcepto" class="block text-gray-700 font-bold mb-2">Nombre del Concepto:</label>
                <input type="text" name="nombreConcepto" id="nombreConcepto" required class="form-input w-full border border-gray-300 p-2 rounded">
                @error('nombreConcepto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Crear Concepto
                </button>
            </div>
        </form>
    </div>

    <!-- Inicio footer -->
    @include('includes.footer')
    <!-- Fin footer -->
    
</body>
</html>