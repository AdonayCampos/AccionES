<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguridadController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\GestionesController;
use App\Http\Controllers\RegistroUsuario;

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

//RUTAS UNIVERSALES
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/registro_usuario', [App\Http\Controllers\RegistroUsuario::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('roles:1,2');
Route::get('/registro/municipios/{departamentoId}', [RegistroUsuario::class, 'obtenerMunicipios']);
Route::post('/registro/create', [RegistroUsuario::class, 'create_cid']);

Route::get('/municipios/{departamentoId}', [MunicipioController::class, 'obtenerMunicipios']);
Route::post('/obtenermunicipios', [MunicipioController::class, 'obtenerMunicipiosMultiples'])->name('obtenermunicipios');

//RUTAS DEL MODULOS DE SEGURIDAD
Route::get('/seguridad', [SeguridadController::class, 'index'])->middleware('roles:1,2');

//RUTAS DE GESTION DE EMPLEADOS
Route::get('/empleado', [SeguridadController::class, 'listar_empleados'])->middleware('roles:1,2');
//Ruta Crear (Formulario)
Route::get('/empleado/crear', [SeguridadController::class, 'crear_emp'])->middleware('roles:1,2');
//Ruta Insert (Back)
Route::post('/empleado/create', [SeguridadController::class, 'create_emp'])->middleware('roles:1,2');
//Ruta Update (Formulario)
Route::get('/empleado/editar/{empleado}', [SeguridadController::class, 'cargar_edit_emp'])->middleware('roles:1,2');
//Ruta Update (Back)
Route::put('/empleado/edit/{empleado}', [SeguridadController::class, 'editar_emp'])->middleware('roles:1,2');
//Ruta Delete(Back)
Route::delete('/empleado/eliminar/{empleado}', [SeguridadController::class, 'eliminar_emp'])->middleware('roles:1');
//Ruta Update (Formulario)
Route::get('/empleado/usuario/editar/{usuario}', [SeguridadController::class, 'cargar_edit_usu_emp'])->middleware('roles:1,2');
//Ruta Create (Formulario)
Route::get('/empleado/usuario/crear/{empleado}', [SeguridadController::class, 'cargar_crear_usu_emp'])->middleware('roles:1,2');
//Ruta Update (Back)
Route::put('/empleado/usuario/edit/{usuario}', [SeguridadController::class, 'editar_usu_emp'])->middleware('roles:1,2');
//Ruta Create (Back)
Route::post('/empleado/usuario/create', [SeguridadController::class, 'create_usu_emp'])->middleware('roles:1,2');

//RUTAS DE GESTION DE USUARIO
Route::get('/usuario', [SeguridadController::class, 'listar_usuarios'])->middleware('roles:1,2');
//Ruta Update (Formulario)
Route::get('/usuario/editar/{usuario}', [SeguridadController::class, 'cargar_edit'])->middleware('roles:1,2');
//Ruta Update (Back)
Route::put('/usuario/edit/{usuario}', [SeguridadController::class, 'editar_usu'])->middleware('roles:1,2');
//Ruta Delete(Back)
Route::delete('/usuario/eliminar/{id}', [SeguridadController::class, 'eliminar_usu'])->middleware('roles:1');

//RUTAS DEL MODULOS DE SEGURIDAD
Route::get('/gestiones', [GestionesController::class, 'index'])->middleware('roles:1,2');
//RUTAS DE GESTION DE DEPARTAMENTOS Y MUNICIPIOS
Route::get('/gestiones/cat/departamentos', [MunicipioController::class, 'listar_dep'])->middleware('roles:1,2');
//Ruta Create (Formulario)
Route::get('/gestiones/cat/departamentos/crear', [MunicipioController::class, 'cargar_crear_dep'])->middleware('roles:1,2');
//Ruta Create (Back)
Route::post('/gestiones/cat/departamentos/create', [MunicipioController::class, 'create_dep'])->middleware('roles:1,2');
//Ruta Update (Formulario)
Route::get('/gestiones/cat/departamentos/editar/{departamento}', [MunicipioController::class, 'cargar_edit_dep'])->middleware('roles:1,2');
//Ruta Update (Back)
Route::put('/gestiones/cat/departamentos/edit/{departamento}', [MunicipioController::class, 'editar_dep'])->middleware('roles:1,2');
//Ruta Delete(Back)
Route::delete('/gestiones/cat/departamentos/eliminar/{departamento}', [MunicipioController::class, 'eliminar_dep'])->middleware('roles:1');


Route::get('/gestiones/cat/municipios/listar/{departamento}', [MunicipioController::class, 'listar_mun_byIdDep'])->middleware('roles:1,2');
//Ruta Create (Formulario)
Route::get('/gestiones/cat/municipios/crear/{departamento}', [MunicipioController::class, 'cargar_crear_mun'])->middleware('roles:1,2');
//Ruta Create (Back)
Route::post('/gestiones/cat/municipios/create', [MunicipioController::class, 'create_mun'])->middleware('roles:1,2');
//Ruta Update (Formulario)
Route::get('/gestiones/cat/municipios/editar/{municipio}', [MunicipioController::class, 'cargar_edit_mun'])->middleware('roles:1,2');
//Ruta Update (Back)
Route::put('/gestiones/cat/municipios/edit/{municipio}', [MunicipioController::class, 'editar_mun'])->middleware('roles:1,2');
//Ruta Delete(Back)
Route::delete('/gestiones/cat/municipios/eliminar/{municipio}', [MunicipioController::class, 'eliminar_mun'])->middleware('roles:1');

//RUTAS DEL MODULOS DE GESTION DE PROYECTOS
Route::get('/gestiones/listar', [GestionesController::class, 'listar_todo'])->middleware('roles:1,2');
//Ruta Create (Formulario)
Route::get('/gestiones/crear', [GestionesController::class, 'cargar_crear'])->middleware('roles:1,2');
//Ruta Create (Back)
Route::post('/gestiones/create', [GestionesController::class, 'create_gest'])->middleware('roles:1,2');
//Ruta Update (Formulario)
Route::get('/gestiones/editar/{gestion}', [GestionesController::class, 'cargar_edit'])->middleware('roles:1,2');
//Ruta Update (Back)
Route::put('/gestiones/edit/{gestion}', [GestionesController::class, 'edit_gest'])->middleware('roles:1,2');
//Ruta Delete(Back)
Route::delete('/gestiones/eliminar/{gestion}', [GestionesController::class, 'eliminar_dep'])->middleware('roles:1');
//Aprobar Gestion
Route::put('/gestiones/listar/aprobar/{gestion}', [GestionesController::class, 'aprobar_ges'])->middleware('roles:1');
//Revertir Gestion
Route::put('/gestiones/listar/revertir/{gestion}', [GestionesController::class, 'revertir_ges'])->middleware('roles:1');
//Ejecutar Gestion
Route::put('/gestiones/listar/ejecutar/{gestion}', [GestionesController::class, 'ejecutar_ges'])->middleware('roles:1');
//Finalizar Gestion
Route::put('/gestiones/listar/finalizar/{gestion}', [GestionesController::class, 'finalizar_ges'])->middleware('roles:1');
//RUTAS DE RESPONSABLES POR GESTION
Route::get('/gestiones/{gestion}/responsable/listar', [GestionesController::class, 'listar_responxGesId'])->middleware('roles:1,2');
//Ruta Create (Formulario)
Route::get('/gestiones/{gestion}/responsable/crear', [GestionesController::class, 'cargar_crear_reg'])->middleware('roles:1,2');
//Ruta Create (Back)
Route::post('/gestiones/responsable/create', [GestionesController::class, 'create_reg'])->middleware('roles:1,2');
//Ruta Delete(Back)
Route::delete('/gestiones/{id}/responsable/eliminar', [GestionesController::class, 'eliminar_reg'])->middleware('roles:1,2');

//RUTAS DE REPORTES
Route::get('/reportes', [ReportController::class, 'reporte_principal'])->middleware('roles:1,2,3');
Route::get('/reportes/gesxestado', [ReportController::class, 'pantalla_gestionesxestado'])->middleware('roles:1,2');
Route::get('/reportes/pdf/gesxestado/{gestiones}', [ReportController::class, 'generar_gestionesxestado'])->middleware('roles:1,2');
Route::get('/reportes/gesxmun', [ReportController::class, 'pantalla_gestionesxmun'])->middleware('roles:1,2');
Route::get('/reportes/pdf/gesxmunicipio/{gestiones}', [ReportController::class, 'generar_gestionesxmunicipio'])->middleware('roles:1,2');
Route::get('/reportes/resxges', [ReportController::class, 'pantalla_resxges'])->middleware('roles:1,2');
Route::get('/reportes/pdf/resxges/{responsables}', [ReportController::class, 'generar_responsablexges'])->middleware('roles:1,2');