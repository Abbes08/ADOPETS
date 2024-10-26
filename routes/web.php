<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdopcionExitosaController;
use App\Http\Controllers\servicioController;
use App\Http\Controllers\PublicidadController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\TransaccionController;

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
Route::middleware(['auth'])->group(function () {
    Route::resource('mascotas', MascotaController::class);
});

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



Route::middleware(['auth'])->group(function () {
    Route::resource('adopciones_exitosas', AdopcionExitosaController::class);
});

//CRUD USUARIO
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Rutas para el CRUD de Publicidad
Route::get('/publicidad', [PublicidadController::class, 'index'])->name('publicidad.index');
Route::get('/publicidad/create', [PublicidadController::class, 'create'])->name('publicidad.create');
Route::post('/publicidad', [PublicidadController::class, 'store'])->name('publicidad.store');
Route::get('/publicidad/{publicidad}/edit', [PublicidadController::class, 'edit'])->name('publicidad.edit');
Route::put('/publicidad/{publicidad}', [PublicidadController::class, 'update'])->name('publicidad.update');
Route::delete('/publicidad/{publicidad}', [PublicidadController::class, 'destroy'])->name('publicidad.destroy');
Route::get('/publicidad/{publicidad}', [PublicidadController::class, 'show'])->name('publicidad.show');

//CRUD DE MASCOTAS
Route::get('/mascotas/{mascota}', [MascotaController::class, 'show'])->name('mascotas.show');
Route::get('/mascotas', [MascotaController::class, 'index'])->name('mascotas.index');
Route::get('/mascotas/create', [MascotaController::class, 'create'])->name('mascotas.create');
Route::post('/mascotas', [MascotaController::class, 'store'])->name('mascotas.store');
Route::get('/mascotas/{mascota}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');
Route::put('/mascotas/{mascota}', [MascotaController::class,'update'])->name('mascotas.update');
Route::delete('/mascotas/{mascota}', [MascotaController::class,'destroy'])->name('mascotas.destroy');

// Ruta para adquirir (adoptar o comprar) una mascota
Route::post('/mascotas/{mascota}/adquirir', [TransaccionController::class, 'store'])->name('mascotas.adquirir');
Route::get('/mascotas/{mascota}', [MascotaController::class, 'detalle'])->name('mascotas.detalle');

//RUTAS PARA ADOPCIONES EXITOSAS
Route::get('/adopciones_exitosas/{id}', [AdopcionExitosaController::class, 'show'])->name('adopciones_exitosas.show');
Route::get('/adopciones_exitosas/{id}/edit', [AdopcionExitosaController::class, 'edit'])->name('adopciones_exitosas.edit');
Route::put('/adopciones_exitosas/{id}', [AdopcionExitosaController::class, 'update'])->name('adopciones_exitosas.update');
Route::delete('/adopciones_exitosas/{id}', [AdopcionExitosaController::class, 'destroy'])->name('adopciones_exitosas.destroy');
//CRUD DE SERVICIOS

Route::resource('servicio', ServicioController::class);
Route::get('/servicio/{servicio}', [servicioController::class, 'show'])->name('servicio.show');
Route::get('/servicio', [servicioController::class, 'index'])->name('servicio.index');
Route::get('/servicio/create', [servicioController::class, 'create'])->name('servicio.create');
Route::post('/servicio', [servicioController::class, 'store'])->name('servicio.store');
Route::get('/servicio/{servicio}/edit', [servicioController::class, 'edit'])->name('servicio.edit');
Route::put('/servicio/{servicio}', [servicioController::class,'update'])->name('servicio.update');
Route::delete('/servicio/{mascota}', [servicioController::class,'destroy'])->name('servicio.destroy');

// INFORMATIVO


// Ruta para mostrar la publicidad en la vista 'vet'
Route::get('/vet', [PublicidadController::class, 'mostrarPublicidad'])->name('vet');
Route::get('/blog', [AdopcionExitosaController::class, 'mostrarAdopcionExitosa'])->name('blog');
Route::get('/services', [ServicioController::class, 'mostrarServicio'])->name('services');
Route::get('/gallery', [MascotaController::class, 'mostrarMascotas'])->name('gallery');
Route::get('/mascotas/{id}', [InformativoMascotasController::class, 'show'])->name('mascotas.show');