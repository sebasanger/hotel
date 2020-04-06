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

Auth::routes(["register" => false]);

Route::middleware(['auth'])->group(function () {

  Route::middleware(['role:1'])->group(function () {

    Route::apiResource('caja', 'CajaController');

    Route::apiResource('categoria', 'CategoriaController');

    Route::apiResource('factura', 'FacturaController');

    Route::apiResource('habitacion', 'HabitacionController');

    Route::apiResource('ingresoProducto', 'IngresoProductoController');

    Route::apiResource('marca', 'MarcaController');

    Route::apiResource('modoPago', 'ModoPagoController');

    Route::apiResource('motivo', 'MotivoController');

    Route::apiResource('precioHabitacion', 'PrecioHabitacionController');

    Route::apiResource('producto', 'ProductoController');

    Route::apiResource('user', 'UserController');
  });

  Route::apiResource('cliente', 'ClienteController');

  Route::apiResource('consumo', 'ConsumoController');

  Route::apiResource('movimiento', 'MovimientoController');

  Route::apiResource('pago', 'PagoController');

  Route::apiResource('reserva', 'ReservaController');

  Route::get('findUser/{text?}','UserController@userFilter');

  Route::get('findCliente/{text?}','ClienteController@clienteFilter');

  Route::get('findIngreso/{text?}','IngresoProductoController@ingresoFilter');

  Route::get('{path}', 'HomeController@index')->where( 'path' , '([A-z\d\-\/_.]+)?' );
});


