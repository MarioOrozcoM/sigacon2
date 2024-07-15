<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Mi Perfil</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio navegación superior -->
<header class="bg-black">
    <div class="container mx-auto flex items-center justify-between px-4 py-2 text-white">
        
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-60">
        
        <div class="flex space-x-4 text-lg uppercase">
            <a href="{{ url('/logados') }}" class="hover:text-gray-400">Regresar</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:text-gray-400 uppercase">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</header> <!-- Cierre navegación superior -->

<!-- Inicio formulario del perfil -->
<form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        <div class="card-body w-full max-w-md mx-auto mt-8">
                            @if (session('status'))
                                <div class="text-lg alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="text-lg alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <h1 class="text-2xl text-center font-bold">Mi Perfil</h1>
                            <div class="mb-4">
                            <label for="nombre" class="block font-semibold mb-2">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ Auth::user()->first_name }} {{ Auth::user()->second_name ? Auth::user()->second_name : '' }} {{ Auth::user()->first_lastname }} {{ Auth::user()->second_lastname ? Auth::user()->second_lastname : '' }}"
 readonly
                                class="w-full border border-gray-300 rounded-md py-2 px-4" disabled>
                            </div>

                            <div class="mb-4">
                            <label for="usuario" class="block font-semibold mb-2">Usuario - Email</label>
                            <input type="text" id="usuario" name="usuario" value="{{ Auth::user()->email }}" readonly
                                class="w-full border border-gray-300 rounded-md py-2 px-4" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="oldPasswordInput" class="form-label block font-semibold mb-2">Contraseña actual</label>
                                <input name="old_password" type="password" class="w-full border border-gray-300 rounded-md py-2 px-4 form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label block font-semibold mb-2">Nueva Contraseña</label>
                                <input name="new_password" type="password" class="w-full border border-gray-300 rounded-md py-2 px-4 form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput" class="form-label block font-semibold mb-2">Confirmar nueva contraseña</label>
                                <input name="new_password_confirmation" type="password" class="w-full border border-gray-300 rounded-md py-2 px-4 form-control" id="confirmNewPasswordInput"
                                    placeholder="Confirm New Password">
                            </div>

                        </div>

                        <div class=" text-2xl font-semibold card-footer w-full max-w-md mx-auto mt-8 text-right">
                            <button class="bg-orange-600 rounded btn btn-success">Aceptar</button>
                        </div>

</form>
<!-- Cierre formulario del perfil -->

<!-- Inicio Footer -->
<footer class="bg-black text-white py-4 mt-auto">
    <div class="container mx-auto px-4">
            <div class="text-white text-2xl text-center">
                <p>Todos los Derechos Reservados {{ date('Y') }} &copy;</p>
            </div>
    </div>
</footer>
<!-- Cierre Footer -->

</body>
</html>