<?php

use App\Http\Controllers\RazaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//LISTA DE RUTAS DATATABLES
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('razas/list', [RazaController::class, 'getRazas'])->name('razas.list');
    Route::get('usuarios/list', [UsuarioController::class, 'getUsuarios'])->name('usuarios.list');
});

Route::middleware(['auth:sanctum'])->group(function () {
    /*
    Route::resource('bovinos', BovinoController::class)->except(['show', 'create'])->names([
        'index' => 'bovinos.index',
        'store' => 'bovinos.store',
        'edit' => 'bovinos.edit',
        'update' => 'bovinos.update',
        'destroy' => 'bovinos.destroy',
    ]);
    */
    Route::resource('usuarios', UsuarioController::class)->except(['show', 'create'])->names([
        'index' => 'usuarios.index',
        'store' => 'usuarios.store',
        'edit' => 'usuarios.edit',
        'update' => 'usuarios.update',
        'destroy' => 'usuarios.destroy',
    ]);
    Route::resource('razas', RazaController::class)->except(['show', 'create'])->names([
        'index' => 'razas.index',
        'store' => 'razas.store',
        'edit' => 'razas.edit',
        'update' => 'razas.update',
        'destroy' => 'razas.destroy',
    ]);
});
