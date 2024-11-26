<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ExcelEmpresaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\CuotasPHController;
use App\Http\Controllers\FacturaCopropiedadController;
use App\Http\Controllers\EmpresaDetalleController;

use App\Models\Unidad;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas publicas
Route::get('/', function () {
    return view('welcome');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/inicio_sesion', function () {
    return view('inicio_sesion');
});
// Fin rutas publicas

// Route::get('/user_dashboard', function () {
//     return view('user_dashboard');
// });


// Inicio rutas privadas
Route::get('/logados', function () {
    return view('logados');
});


Route::get('/main', function () {
    return view('main');
});

Route::get('/mi_perfil', function () {
    return view('mi_perfil');
});

Route::get('/crear_editar_catalogos', function () {
    return view('seccionAdministracion.crear_editar_catalogos');
});

Route::get('/options_ph', function () {
    return view('seccionPropiedadHorizontal.optionsPropiedadHorizontal');
});

// Route::get('/adminEmpresas', function () {
//     return view('superUsuario.empresas.adminEmpresas');
// });


// Route::get('/admin/users', function () {
//     return view('superUsuario.adminUsers');
// });

Route::get('/adminCopropiedades', function (){
    return view('superUsuario.copropiedades.adminCopropiedades');
});

//VIsta de Facturación principal
Route::get('/opciones_facturas', function (){
    return view('facturacion.indexFacturacion');
});




Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::get('/', [AuthController::class, 'index'])->name('home');
// Ruta para mostrar el formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta para manejar el envío del formulario de login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logados', [AuthController::class, 'logados'])->name('logados'); // Ruta para la página después de iniciar sesión

// Rutas para el cambio de contraseña
Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password'); 
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');

// Ruta para mostrar la vista principal (main), es para que la variable $user funcione
Route::get('/main', [AuthController::class, 'main'])->name('main')->middleware('auth');


//Ruta para que la vista de adminUsers.blade le funcione la variable $user
// Route::get('/admin/users', [AuthController::class, 'adminUsers'])->name('adminUsers')->middleware('auth');

// Rutas para mostrar la lista de usuarios y agregar un nuevo usuario
Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');

// Ruta para eliminar un usuario
//Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle'); //Inhabilitar o habilitar un usuario


// rutas para editar un usuario
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');


// Ruta para descargar el Excel de un usuario específico
Route::get('/download-excel/{userId}', [ExcelController::class, 'downloadExcel'])->name('download.excel');
//Ruta para descargar el Excel de una empresa específica
Route::get('/download-excel-empresa/{empresaId}', [ExcelEmpresaController::class, 'downloadExcelEmpresa'])->name('download.excel.empresa');


Route::get('/get-states/{country_id}', [UserController::class, 'getStates'])->name('get.states');


Route::get('/get-cities/{state_id}', [UserController::class, 'getCities'])->name('get.cities');


// Rutas para mostrar la lista de empresas y crear una nueva empresa
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
Route::get('/empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');
Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresas.store');

// Rutas para mostrar el formulario de edición y actualizar una empresa
Route::get('/empresas/{empresa}/edit', [EmpresaController::class, 'edit'])->name('empresas.edit');
Route::put('/empresas/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');

// Ruta para habilitar o inhabilitar una empresa
Route::put('/empresas/{empresa}/toggle', [EmpresaController::class, 'toggle'])->name('empresas.toggle');


// Rutas para el controlador de Unidades
// Route::resource('unidades', UnidadController::class);

// Rutas personalizadas para el controlador de Unidades
Route::get('/unidades', [UnidadController::class, 'index'])->name('unidades.index');
Route::get('/unidades/create', [UnidadController::class, 'create'])->name('unidades.create');
Route::post('/unidades', [UnidadController::class, 'store'])->name('unidades.store');
Route::get('/unidades/{unidad}/edit', [UnidadController::class, 'edit'])->name('unidades.edit');
Route::put('/unidades/{unidad}', [UnidadController::class, 'update'])->name('unidades.update');
Route::delete('/unidades/{unidad}', [UnidadController::class, 'destroy'])->name('unidades.destroy');
Route::get('/unidades/export', [UnidadController::class, 'export'])->name('unidades.export');

//Rutas personalizadas para el controlador ConceptoController
Route::get('/conceptos', [ConceptoController::class, 'index'])->name('conceptos.index');
Route::get('/conceptos/crear', [ConceptoController::class, 'create'])->name('conceptos.create');
Route::post('/conceptos', [ConceptoController::class, 'store'])->name('conceptos.store');
Route::delete('/conceptos/{concepto}', [ConceptoController::class, 'destroy'])->name('conceptos.destroy');



// Rutas personalizadas para el controlador CuotasPHController
// Ruta para listar las cuotas y seleccionar una empresa para mostrar sus unidades
Route::get('/cuotasPH', [CuotasPHController::class, 'index'])->name('cuotasPH.index');

// Ruta para mostrar el formulario de creación de una nueva cuota
Route::get('/cuotasPH/create', [CuotasPHController::class, 'create'])->name('cuotasPH.create');

// Ruta para almacenar una nueva cuota
Route::post('/cuotasPH', [CuotasPHController::class, 'store'])->name('cuotasPH.store');

// Ruta para actualizar los datos de una cuota específica
Route::put('/cuotasPH/update', [CuotasPHController::class, 'update'])->name('cuotasPH.update'); // Cambiado a /update

// Ruta para eliminar una cuota específica
Route::delete('/cuotasPH/{cuota}', [CuotasPHController::class, 'destroy'])->name('cuotasPH.destroy');

// Ruta para obtener las unidades de una empresa específica
Route::get('/empresas/{empresaId}/unidades', [CuotasPHController::class, 'getUnidadesByEmpresa']);

// Ruta para exportar a Excel las cuotas de una empresa seleccionada
Route::get('/cuotasPH/export', [CuotasPHController::class, 'export'])->name('cuotasPH.export');


//RUTAS FACTURACIÓN COPROPIEDAD
Route::get('/facturacion', [FacturaCopropiedadController::class, 'seleccionarEmpresa'])->name('facturas.seleccionar');
Route::post('/facturacion/generar', [FacturaCopropiedadController::class, 'generarFactura'])->name('facturas.generar');

// Muestra la vista para configurar la facturación en bloque
Route::get('/facturacion/bloque/configurar/{empresa_id?}', [FacturaCopropiedadController::class, 'configurarFacturacionEnBloque'])
    ->name('facturas.bloque.configurar');

// Procesa y genera las facturas en bloque
Route::post('/facturacion/bloque/generar', [FacturaCopropiedadController::class, 'generarFacturacionEnBloque'])
    ->name('facturas.bloque.generar');


//RUTAS CORREO COMPROBANTE Y N° CUENTA BANCARIA DE EMPRESA
Route::get('/empresa-detalles', [EmpresaDetalleController::class, 'index'])->name('empresa_detalles.index');
Route::get('/empresa-detalles/create/{empresa}', [EmpresaDetalleController::class, 'create'])->name('empresa_detalles.create');
Route::post('/empresa-detalles/store/{empresa}', [EmpresaDetalleController::class, 'store'])->name('empresa_detalles.store');
Route::get('/empresa-detalles/{id}/edit', [EmpresaDetalleController::class, 'edit'])->name('empresa_detalles.edit');
Route::put('/empresa-detalles/{id}', [EmpresaDetalleController::class, 'update'])->name('empresa_detalles.update');
Route::delete('/empresa-detalles/{id}', [EmpresaDetalleController::class, 'destroy'])->name('empresa_detalles.destroy');