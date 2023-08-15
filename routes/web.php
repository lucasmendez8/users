<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('auth.home');

//MODULOS
Route::get('/modulos', [App\Http\Controllers\ModuloController::class, 'index'])->name('modulos');
Route::get('/modulos/nuevo', [App\Http\Controllers\ModuloController::class, 'new'])->name('modulos.new');
Route::post('/modulos/nuevo', [App\Http\Controllers\ModuloController::class, 'store'])->name('modulos.store');
Route::get('/modulos/editar/{modulo}', [App\Http\Controllers\ModuloController::class, 'edit'])->name('modulos.edit');
Route::put('/modulos/editar/{modulo}', [App\Http\Controllers\ModuloController::class, 'update'])->name('modulos.update');

//PERMISOS
Route::get('/modulos/{modulo}/permisos/nuevo', [App\Http\Controllers\PermisoController::class, 'new'])->name('permisos.new');
Route::post('/modulos/{modulo}/permisos/nuevo', [App\Http\Controllers\PermisoController::class, 'store'])->name('permisos.store');
Route::get('/permisos/editar/{permiso}', [App\Http\Controllers\PermisoController::class, 'edit'])->name('permisos.edit');
Route::put('/permisos/editar/{permiso}', [App\Http\Controllers\PermisoController::class, 'update'])->name('permisos.update');


//USUARIOS
Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios');
Route::get('/usuarios/nuevo', [App\Http\Controllers\UserController::class, 'new'])->name('usuarios.new');
Route::post('/usuarios/nuevo', [App\Http\Controllers\UserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/editar/{usuario}', [App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/editar/{usuario}', [App\Http\Controllers\UserController::class, 'update'])->name('usuarios.update');

Route::get('/usuarios/primer-login', [App\Http\Controllers\UserController::class, 'primerLogin'])->name('usuarios.primerLogin');
Route::put('/usuario/primer-login/{usuario}', [App\Http\Controllers\UserController::class, 'setearPassword'])->name('usuarios.setearPassword');

Route::get('/usuarios/modificar-password', [App\Http\Controllers\UserController::class, 'cambiarPassword'])->name('usuarios.cambiarPassword');
