<?php

namespace App\Http\Controllers;

use App\Caja;
use App\IngresoProducto;
use App\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IngresoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($query = null)
    {
        if (empty($query)) {
            $ingresosProductos = IngresoProducto::leftJoin('productos', 'ingresosProductos.productos_id', '=', 'productos.id')
                ->leftJoin('users', 'ingresosProductos.users_id', '=', 'users.id')
                ->leftJoin('modospagos', 'ingresosProductos.modosPagos_id', '=', 'modospagos.id')
                ->select('ingresosProductos.*', 'modospagos.modoPago', 'productos.producto', 'users.name')
                ->latest()
                ->paginate(10);
        } else {
            $ingresosProductos = IngresoProducto::leftJoin('productos', 'ingresosProductos.productos_id', '=', 'productos.id')
                ->leftJoin('users', 'ingresosProductos.users_id', '=', 'users.id')
                ->leftJoin('modospagos', 'ingresosProductos.modosPagos_id', '=', 'modospagos.id')
                ->select('ingresosProductos.*', 'modospagos.modoPago', 'productos.producto', 'users.name')
                ->where('productos_id', '=', $query)
                ->latest()
                ->paginate(10);
        }

        return $ingresosProductos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cantidadIngreso' => 'required|numeric',
            'precioCompra' => 'required|numeric',
            'productos_id' => 'required|numeric',
            'modosPagos_id' => 'required|numeric',
        ]);

        $ingreso = new IngresoProducto();
        $ingreso->cantidadIngreso = $request->cantidadIngreso;
        $ingreso->precioCompra = $request->precioCompra;
        $ingreso->productos_id = $request->productos_id;
        $ingreso->modosPagos_id = $request->modosPagos_id;
        $ingreso->users_id = Auth::user()->id;
        $stockActual = $ingreso->productos->stock;
        $stockFinal = $stockActual + $request->cantidadIngreso;
        $ingreso->productos->update(['stock' => $stockFinal]);


        $cajaId = Caja::where('cajaActiva', 1)->first();
        $caja = Caja::findOrFail($cajaId->id);
        //si fue pagado se actualiza el saldo de la caja
        $caja->saldo -= $request->cantidadIngreso * $request->precioCompra;
        $caja->save();
        //fin parte de cajas

        //Agregado de pago en la reserva en caso de que este pagada o almenos en parte
        $movimiento = new Movimiento();
        $movimiento->monto = $request->cantidadIngreso * $request->precioCompra;
        $movimiento->modosPagos_id = $request->modosPagos_id;
        $movimiento->cajas_id = $cajaId->id;
        $movimiento->tipo = 0;
        $movimiento->descripcion = "ingreso de producto: " . $ingreso->productos->producto;
        $movimiento->users_id = Auth::user()->id;
        $movimiento->save();
        //Agregado de pago en la reserva en caso de que este pagada o almenos en parte


        $ingreso->save();

        return $ingreso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IngresoProducto  $ingresoProducto
     * @return \Illuminate\Http\Response
     */
    public function show(IngresoProducto $ingresoProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IngresoProducto  $ingresoProducto
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IngresoProducto  $ingresoProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingreso = IngresoProducto::findOrFail($id);
        $nuevoReducido = $ingreso->productos->stock - $ingreso->cantidadIngreso;
        $ingreso->productos->update(['stock' => $nuevoReducido]);
        $ingreso->delete();
        return $ingreso;
    }

    public function ingresoFilter($query = null)
    {
        if (!empty($query)) {
            $ingresosProductos = IngresoProducto::leftJoin('productos', 'ingresosproductos.productos_id', '=', 'productos.id')
                ->leftJoin('users', 'ingresosproductos.users_id', '=', 'users.id')
                ->leftJoin('modosPagos', 'ingresosproductos.modosPagos_id', '=', 'modosPagos.id')
                ->select('ingresosproductos.*', 'modosPagos.modoPago', 'productos.producto', 'users.name')
                ->where('productos_id', '=', $query)
                ->latest()
                ->paginate(40);
        } else {
            $ingresosProductos = IngresoProducto::leftJoin('productos', 'ingresosproductos.productos_id', '=', 'productos.id')
                ->leftJoin('users', 'ingresosproductos.users_id', '=', 'users.id')
                ->leftJoin('modosPagos', 'ingresosproductos.modosPagos_id', '=', 'modosPagos.id')
                ->select('ingresosproductos.*', 'modosPagos.modoPago', 'productos.producto', 'users.name')
                ->latest()
                ->paginate(10);
        }

        return $ingresosProductos;
    }
}
