<?php

use App\Http\Controllers\TiendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;



// GET: SE UTILIZA PARA OBTENER DATOS DEL SERVIDOR
// POST: SE UTILIZA PARA ENVIAR DATGOS AL SERVIDOR

// Ruta para la raíz que redirige al listado de jugadores
//Route::get('jugadores', [JugadorController::class, 'index']);

// CRUD de jugadores
//Route::resource('jugadores', JugadorController::class);

Route::get('/', function () {
    return view('principal');
})->name('home');

// Ruta para la página "Nosotros"
Route::get('/nosotros', function () {
    return view('nosotros.nosotros');   //  Esta función anónima devuelve la vista resources/views/nosotros/nosotros.blade.php
})->name('nosotros');

// Ruta para el Login
Route::get('/auth', action: function () {
    return view('auth.login');   //  Esta función anónima devuelve la vista resources/views/nosotros/nosotros.blade.php
})->name('login');

use App\Http\Controllers\AuthController;

// Ruta para mostrar el formulario de registro
Route::get('/register', function () {
    return view('auth.register'); // Asegúrate de que coincida con tu vista
})->name('register');

// Ruta para mostrar la tienda 
// No es necesario poner la ruta de la tienda si tenemos el controlador
// Route::get('/tienda', function () {
//     return view('tienda.tienda');
// })->name('tienda'); 
// Pero tenemos que poner el nombre a la tienda


Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda');

// Ruta para procesar el registro. Esta ruta indica que cuando se envíe una solicitud POST a /register,
// Laravel debe usar el método register del AuthController.)
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit');



