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
    public function index()
    {
        $ingresosProductos = DB::table('ingresosProductos')
            ->leftJoin('productos', 'ingresosProductos.productos_id', '=', 'productos.id')
            ->leftJoin('users', 'ingresosProductos.users_id', '=', 'users.id')
            ->leftJoin('modosPagos', 'ingresosProductos.modosPagos_id', '=', 'modosPagos.id')
            ->select('ingresosProductos.*', 'modosPagos.modoPago', 'productos.producto', 'users.name')
            ->latest()
            ->paginate(10);

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
        $ingreso->cantidadIngreso = $request->cantidadIngreso;
        $ingreso->precioCompra = $request->precioCompra;
        $ingreso->productos_id = $request->productos_id;
        $ingreso->modosPagos_id = $request->modosPagos_id;
        $ingreso->users_id = Auth::user()->id;


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
        $ingreso->delete();
        return $ingreso;
    }

    public function ingresoFilter($query = null)
    {
        if (!empty($query)) {
            $filter = trim(strtolower($query));
            $ingresoProducto = IngresoProducto::where('productos_id', '=', $filter)->orderBy('id', 'DESC');
        } else {
            $ingresoProducto = IngresoProducto::orderBy('id', 'DESC')->paginate(10);
        }

        return $ingresoProducto;
    }
}
