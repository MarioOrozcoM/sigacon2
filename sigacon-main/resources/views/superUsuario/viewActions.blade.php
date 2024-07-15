<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Document</title>
</head>
<body>

<!-- Inicio código para mostrar las acciones disponibles -->
<div class="flex justify-center">
    <table class="m-6 w-full border-collapse border">
        <thead class="bg-gray-100">
            <tr class="text-center text-black text-1xl uppercase">
                <th class="px-6 py-3 border-collapse border w-1/5">
                    <a class="font-semibold tracking-wider">Administración</a>
                </th>
                <th class="px-6 py-3 border-collapse border w-1/5">
                    <a class="font-semibold tracking-wider">Documentos</a>
                </th>
                <th class="px-6 py-3 border-collapse border w-1/5">
                    <a class="font-semibold tracking-wider">Reportes</a>
                </th>
                <th class="px-6 py-3 border-collapse border w-1/5">
                    <a class="font-semibold tracking-wider">Gerencia</a>
                </th>
                <th class="px-6 py-3 border-collapse border w-1/5">
                    <a class="font-semibold tracking-wider">Ayuda</a>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 text-gray-600 font-semibold">
            <tr class="divide-x">
            <td class="px-6 py-4"><button onclick="window.location.href = '/crear_editar_catalogos';" class="hover:underline">Crear/Editar Catálogos</button></td>
            <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Tesorería</button></td>
            <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Tesorería</button></td>
            <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Crm</button></td>
            <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
            <tr class="divide-x">
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Activar modulos, usuarios y permisos</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Cuenta por Cobrar</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Cuenta por Cobrar</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Estadísticas</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
            <tr class="divide-x">
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Utilidades</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Cuenta por Pagar</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Cuenta por Pagar</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Publicaciones</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
            <tr class="divide-x">
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Parámetros</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Nomina</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Nomina</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Eventos</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
            <tr class="divide-x">
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Inventarios</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Inventarios</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Alquiler Servicios</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
            <tr class="divide-x">
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Contabilidad</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Contabilidad</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Concejeros</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
            <tr class="divide-x">
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Descuentos Especiales</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
            <tr class="divide-x">
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline"></button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">Con Quién Vivo</button></td>
                <td class="px-6 py-4"><button onclick="window.location.href = '#';" class="hover:underline">""</button></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Fin código para mostrar las acciones disponibles -->
    
</body>
</html>