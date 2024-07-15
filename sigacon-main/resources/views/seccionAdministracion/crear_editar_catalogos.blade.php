<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Crear/editar Catalogos</title>
</head>
<body class="flex flex-col min-h-screen">
 
<!-- Inicio navegación superior -->
@include('includes.header_redirect_main')
<!-- Fin navegación superior -->

<!-- Inicio empresaRol -->
@include('includes.show_rol')
<!-- Cierre empresaRol -->

<div>
    <h1 class="text-center font-semibold text-2xl">Crear/Editar Catálogos</h1>
</div>

<!-- Inicio opciones disponibles -->
<div class="flex justify-center">
    <table class="m-6 w-1/4 border-collapse border text-lg text-black font-semibold">

        <tr>
            <td class="border-b hover:underline">
                <a href="#">1- Crear editar Cuentas</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">2- Crear editar Usuarios/Roles</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">3- Crear editar Reportes</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">4- Crear editar Documentos</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">5- Crear editar Subcategorías</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">6- Crear editar Organización Territorial y Códigos</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">7- Crear editar Nomina</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">8- Crear editar Inventarios</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">9- Crear editar Utilidades</a>
            </td>
        </tr>
        <tr>
            <td class="border-b hover:underline">
                <a href="#">10- Crear editar Contabilidad</a>
            </td>
        </tr>
    </table>
</div>
<!-- Fin opciones disponibles -->



<!-- Inicio Footer -->
@include('includes.footer')
<!-- Cierre Footer -->


<!-- Estilos CSS -->
<style>
    .border-collapse,
    .border,
    .border-b {
        border-color: #C4C4C4;
    }
</style>

</body>
</html>