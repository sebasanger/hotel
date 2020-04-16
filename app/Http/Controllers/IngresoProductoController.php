<?php

namespace App\Http\Controllers;

use App\IngresoProducto;
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
                ->leftJoin('modosPagos', 'ingresosProductos.modosPagos_id', '=', 'modosPagos.id')
                ->select('ingresosProductos.*', 'modosPagos.modoPago', 'productos.producto', 'users.name')
                ->latest()
                ->paginate(10);
        } else {
            $ingresosProductos = IngresoProducto::leftJoin('productos', 'ingresosProductos.productos_id', '=', 'productos.id')
                ->leftJoin('users', 'ingresosProductos.users_id', '=', 'users.id')
                ->leftJoin('modosPagos', 'ingresosProductos.modosPagos_id', '=', 'modosPagos.id')
                ->select('ingresosProductos.*', 'modosPagos.modoPago', 'productos.producto', 'users.name')
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
        $validatedData = $request->validate([
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
    public function update(Request $request, IngresoProducto $ingresoProducto)
    {
        $id = $request->id;

        $request->validate([
            'id' => 'required',
            'cantidadIngreso' => 'required|numeric',
            'precioCompra' => 'required|numeric',
            'productos_id' => 'required|numeric',
            'modosPagos_id' => 'required|numeric',
        ]);

        $ingreso = IngresoProducto::find($request->id);
        $ingreso->precioCompra = $request->precioCompra;
        $ingreso->productos_id = $request->productos_id;
        $ingreso->modosPagos_id = $request->modosPagos_id;
        $ingreso->users_id = Auth::user()->id;

        //se busca la cantidad anterior de entrada del producto
        $ingresoAnterior = $ingreso->getOriginal('cantidadIngreso');
        //se pone en una variable la cantidad de ingreso actual
        $ingresoActual = $request->cantidadIngreso;
        //se verifica que sea haya cambiado la cantidad para hacer un cambio en la cantidad de stock del producto
        if ($ingresoActual != $ingresoAnterior) {
            //al stock actual se le resta el anterior
            $stockActual = $ingreso->productos->stock - $ingresoAnterior;
            //y para sacar el nuevo stock del producto se le suma la nueva cantidad de entrada
            $stockFinal = $stockActual + $ingresoActual;
            //se actualiza el stock del producto
            $ingreso->productos->update(['stock' => $stockFinal]);
            //se guarda la cantidad en el ingreso de producto
            $ingreso->cantidadIngreso = $ingresoActual;
        } else {
            //si la cantidad no es modificada no se realizan los pasos anteriores y solo se guarda nuevamente
            $ingreso->cantidadIngreso = $request->cantidadIngreso;
        }

        $ingreso->save();

        return $ingreso;
    }

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
            $ingresosProductos = IngresoProducto::leftJoin('productos', 'ingresosProductos.productos_id', '=', 'productos.id')
                ->leftJoin('users', 'ingresosProductos.users_id', '=', 'users.id')
                ->leftJoin('modosPagos', 'ingresosProductos.modosPagos_id', '=', 'modosPagos.id')
                ->select('ingresosProductos.*', 'modosPagos.modoPago', 'productos.producto', 'users.name')
                ->where('productos_id', '=', $query)
                ->latest()
                ->paginate(40);
        } else {
            $ingresosProductos = IngresoProducto::leftJoin('productos', 'ingresosProductos.productos_id', '=', 'productos.id')
                ->leftJoin('users', 'ingresosProductos.users_id', '=', 'users.id')
                ->leftJoin('modosPagos', 'ingresosProductos.modosPagos_id', '=', 'modosPagos.id')
                ->select('ingresosProductos.*', 'modosPagos.modoPago', 'productos.producto', 'users.name')
                ->latest()
                ->paginate(10);
        }

        return $ingresosProductos;
    }
}
