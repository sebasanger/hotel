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
    //rutas de carga
    Route::get('getAllCategorias', 'CategoriaController@getAllCategorias');
    Route::get('getAllFacturas', 'FacturaController@getAllFacturas');
    Route::get('getAllMarcas', 'MarcaController@getAllMarcas');
    Route::get('getAllModosPagos', 'ModoPagoController@getAllModosPagos');
    Route::get('getAllMotivos', 'MotivoController@getAllMotivos');
    Route::get('getAllPreciosHabitaciones', 'PrecioHabitacionController@getAllPreciosHabitaciones');
    Route::get('getAllClientes', 'ClienteController@getAllClientes');
    Route::get('getAllHabitaciones', 'HabitacionController@getAllHabitaciones');
    Route::get('getAllProductos', 'ProductoController@getAllProductos');
    Route::get('getAllUsers', 'UserController@getAllUsers');
    //rutas de carga

    //rutas para graficas
    Route::get('getIngresosDiarios', 'MovimientoController@getIngresosDiarios');
    Route::get('getSaldosDiarios/{year}/{month}', 'CajaController@getSaldosDiarios');
    Route::get('getSaldosMensuales/{year}', 'CajaController@getSaldosMensuales');
    Route::get('getIngresosMensuales/{meses?}', 'MovimientoController@getIngresosMensuales');

    Route::get('getReservasDiarias/{year}/{month}', 'ReservaController@getReservasDiarias');
    Route::get('getReservasMensuales/{year}', 'ReservaController@getReservasMensuales');
    //rutas para graficas

    //rutas de caja
    Route::get('getCajaData/{cajaId}', 'CajaController@getCajaData');
    Route::get('getCajaActiva', 'CajaController@getCajaActiva');
    Route::get('getPagosByCaja/{cajaId}', 'PagoController@getPagosByCaja');
    Route::get('getConsumosByCaja/{cajaId}', 'consumoController@getConsumosByCaja');
    Route::get('getIngresos/{cajaId}', 'MovimientoController@getIngresos');
    Route::get('getEgresos/{cajaId}', 'MovimientoController@getEgresos');
    //rutas de caja

    //rutas de reserva
    Route::get('getPagosByReserva/{reservaId}', 'PagoController@getPagosByReserva');
    Route::get('getConsumosByReserva/{reservaId}', 'ConsumoController@getConsumosByReserva');
    Route::get('getProducto/{productoId}', 'ProductoController@getProducto');
    //rutas de reserva

    //rutas de user
    Route::get('userFind', 'UserController@userFind');
    Route::get('findCliente/{id}', 'ClienteController@findCliente');
    //rutas de user

    Route::middleware(['role:1'])->group(function () {


        Route::apiResource('categoria', 'CategoriaController');

        Route::apiResource('factura', 'FacturaController');

        Route::apiResource('habitacion', 'HabitacionController');

        Route::get('ingresoProducto/{filtro?}', 'IngresoProductoController@index');

        Route::apiResource('ingresoProducto', 'IngresoProductoController');

        Route::apiResource('marca', 'MarcaController');

        Route::apiResource('modoPago', 'ModoPagoController');

        Route::apiResource('motivo', 'MotivoController');

        Route::apiResource('precioHabitacion', 'PrecioHabitacionController');

        Route::get('producto/{filtro?}', 'ProductoController@index');

        Route::apiResource('producto', 'ProductoController');

        Route::get('user/{filtro?}', 'UserController@index');

        Route::apiResource('user', 'UserController')->except([
            'index'
        ]);
    });
    Route::get('caja/{filtro?}', 'CajaController@index');

    Route::apiResource('caja', 'CajaController');

    Route::get('cliente/{filtro?}', 'ClienteController@index');

    Route::apiResource('cliente', 'ClienteController');

    Route::apiResource('consumo', 'ConsumoController');

    Route::apiResource('movimiento', 'MovimientoController');

    Route::apiResource('pago', 'PagoController');

    Route::apiResource('reserva', 'ReservaController');

    Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\-\/_.]+)?');
});
