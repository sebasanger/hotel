<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::apiResource('cajas', 'CajaController');

Route::apiResource('categoria', 'CategoriaController');

Route::apiResource('cliente', 'ClienteController');

Route::apiResource('consumo', 'ConsumoController');

Route::apiResource('factura', 'FacturaController');

Route::apiResource('habitacion', 'HabitacionController');

Route::apiResource('ingresoProducto', 'IngresoProductoController');

Route::apiResource('marca', 'MarcaController');

Route::apiResource('modoPago', 'ModoPagoController');

Route::apiResource('motivo', 'MotivoController');

Route::apiResource('movimiento', 'MovimientoController');

Route::apiResource('pago', 'PagoController');

Route::apiResource('precioHabitacion', 'PrecioHabitacionController');

Route::apiResource('producto', 'ProductoController');

Route::apiResource('reserva', 'ReservaController');