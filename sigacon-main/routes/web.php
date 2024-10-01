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




Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::get('/', [AuthController::class, 'index'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login'); // Ruta para el inicio de sesión
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

//Rutas personalizadas para el controlador ConceptoController
Route::get('/conceptos', [ConceptoController::class, 'index'])->name('conceptos.index');
Route::get('/conceptos/crear', [ConceptoController::class, 'create'])->name('conceptos.create');
Route::post('/conceptos', [ConceptoController::class, 'store'])->name('conceptos.store');
Route::delete('/conceptos/{concepto}', [ConceptoController::class, 'destroy'])->name('conceptos.destroy');

//Rutas personalizadas para el controlador CuotasPHController
Route::get('/cuotasPH', [CuotasPHController::class, 'index'])->name('cuotasPH.index');
Route::post('/cuotasPH', [CuotasPHController::class, 'store'])->name('cuotasPH.store');
Route::delete('cuotasPH/{cuota}', [CuotasPHController::class, 'destroy'])->name('cuotasPH.destroy');
Route::get('/cuotasPH/create', [CuotasPHController::class, 'create'])->name('cuotasPH.create');
Route::get('cuotasPH/{cuota}/edit', [CuotasPHController::class, 'edit'])->name('cuotasPH.edit');
Route::put('cuotasPH/{cuota}', [CuotasPHController::class, 'update'])->name('cuotasPH.update');
Route::get('/empresas/{empresaId}/unidades', [CuotasPHController::class, 'getUnidadesByEmpresa']);