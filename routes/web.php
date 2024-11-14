<?php

use App\Http\Controllers\TiendaController;
use App\Http\Controllers\Admin\CreateProductoController;
use App\Http\Controllers\Admin\DeleteProductoController;
use App\Http\Controllers\Admin\UpdateStockController;


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
use App\Http\Controllers\ComprarController;
use App\Http\Controllers\ProductoController;


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
Route::get('/producto/{id}', action: [ProductoController::class, 'detalleProducto'])->name('producto');
Route::post('/comprar/{id}', [ComprarController::class, 'comprar'])->name('comprar');
Route::post('/confirmar/{id}', [ComprarController::class, 'confirmar'])->name('confirmar');

// Rutas de la administracion 
Route::get('/createProductos', [CreateProductoController::class, 'showForm'])->name('createProducts');
Route::post('/createProductos', [CreateProductoController::class, 'store'])->name('createProducts.store');

// Ruta para mostrar la vista de categorías, para mostrar productos de la categoría seleccionada, para eliminar un producto específico
Route::get('/deleteProductos', [DeleteProductoController::class, 'showCategories'])->name('deleteProducts');
Route::get('/deleteProductos/categoria', [DeleteProductoController::class, 'showProductsByCategory'])->name('deleteProducts.filter');
Route::post('/deleteProductos/{producto}/eliminar', [DeleteProductoController::class, 'destroy'])->name('deleteProducts.destroy');

Route::get('/updateStock', [UpdateStockController::class, 'showCategories'])->name('updateStock');
Route::get('/updateStock/category', [UpdateStockController::class, 'showProductsByCategory'])->name('updateStock.category');
Route::post('/updateStock/{producto}', [UpdateStockController::class, 'updateStock'])->name('updateStock.update');

// En este tenemos que poner el parametro ya que estamos enviandolo por el formulario y no recogiendolo desde el Controlador

// Ruta para procesar el registro. Esta ruta indica que cuando se envíe una solicitud POST a /register,
// Laravel debe usar el método register del AuthController.)
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit');



