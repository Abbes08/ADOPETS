<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\exitosasController;
use App\Http\Controllers\PublicidadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/vet', function () {
    return view('vet');
})->name('vet');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/blog-single', function () {
    return view('blog-single');
})->name('blog-single');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//CRUD USUARIO
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

//CRUD ADOPEXITOSAS
Route::resource('exitosas', exitosasController::class);
Route::get('/exitosas', [exitosasController::class, 'index'])->name('exitosas.index');
Route::get('/exitosas/create', [exitosasController::class, 'create'])->name('exitosas.create');
Route::post('/exitosas', [exitosasController::class, 'store'])->name('exitosas.store');
Route::get('/exitosas/{id}/edit', [exitosasController::class, 'edit'])->name('exitosas.edit');
Route::put('/exitosas/{id}', [exitosasController::class, 'update'])->name('exitosas.update');
Route::delete('/exitosas/{id}', [exitosasController::class, 'destroy'])->name('exitosas.destroy');

//CRUD AdopExitosas


// Rutas para el CRUD de Publicidad
Route::get('/publicidad', [PublicidadController::class, 'index'])->name('publicidad.index');
Route::get('/publicidad/create', [PublicidadController::class, 'create'])->name('publicidad.create');
Route::post('/publicidad', [PublicidadController::class, 'store'])->name('publicidad.store');
Route::get('/publicidad/{publicidad}/edit', [PublicidadController::class, 'edit'])->name('publicidad.edit');
Route::put('/publicidad/{publicidad}', [PublicidadController::class, 'update'])->name('publicidad.update');
Route::delete('/publicidad/{publicidad}', [PublicidadController::class, 'destroy'])->name('publicidad.destroy');
Route::get('/publicidad/{publicidad}', [PublicidadController::class, 'show'])->name('publicidad.show');


