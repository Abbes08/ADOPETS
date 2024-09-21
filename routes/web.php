<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\exitosasController;


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


//CRUD DE SERVICIOS
Route::resource('servicio', servicioController::class);
Route::get('/servicio', [servicioController::class, 'index'])->name('servicio.index');
Route::get('/servicio/create', [servicioController::class, 'create'])->name('servicio.create');
Route::post('/servicio', [servicioController::class, 'store'])->name('servicio.store');
Route::get('/servicio/{id}/edit', [servicioController::class, 'edit'])->name('servicio.edit');
Route::put('/servicio/{id}', [servicioController::class, 'update'])->name('servicio.update');
Route::delete('/servicio/{id}', [servicioController::class, 'destroy'])->name('servicio.destroy');

//CRUD DE MASCOTAS
Route::resource('mascota', mascotaController::class);
Route::get('/mascota', [mascotaController::class, 'index'])->name('mascota.index');
Route::get('/mascota/create', [mascotaController::class, 'create'])->name('mascota.create');
Route::post('/mascota', [mascotaController::class, 'store'])->name('mascota.store');
Route::get('/mascota/{id}/edit', [mascotaController::class,'edit'])->name('mascota.edit');
Route::put('/mascota/{id}', [mascotaController::class, 'update'])->name('mascota.update');
Route::delete('/mascota/{id}', [mascotaController::class, 'destroy'])->name('mascota.destroy');

