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


Route::get('/modulos', [App\Http\Controllers\ModuloController::class, 'index'])->name('modulos');
Route::get('/modulos/nuevo', [App\Http\Controllers\ModuloController::class, 'new'])->name('modulos.new');
Route::post('/modulos/nuevo', [App\Http\Controllers\ModuloController::class, 'store'])->name('modulos.store');
Route::get('/modulos/editar/{modulo}', [App\Http\Controllers\ModuloController::class, 'edit'])->name('modulos.edit');
Route::put('/modulos/editar/{modulo}', [App\Http\Controllers\ModuloController::class, 'update'])->name('modulos.update');

Route::get('/permisos', [App\Http\Controllers\PermisoController::class, 'index'])->name('auth.permisos');
