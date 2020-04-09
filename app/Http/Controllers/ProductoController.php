<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Producto::leftJoin('categorias', 'productos.categorias_id', '=', 'categorias.id')
            ->leftJoin('marcas', 'productos.marcas_id', '=', 'marcas.id')
            ->select('productos.*', 'marcas.marca', 'categorias.categoria')
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return $clientes;
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
            'producto' => 'required|string|min:2|max:30',
            'codigoProducto' => 'required|string|min:2|max:30',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'categorias_id' => 'required|numeric',
            'marcas_id' => 'required|numeric',

        ]);

        $producto = new Producto();
        $producto->producto = $request->producto;
        $producto->codigoProducto = $request->codigoProducto;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categorias_id = $request->categorias_id;
        $producto->marcas_id = $request->marcas_id;

        $producto->save();

        return $producto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $id = $request->id;

        $request->validate([
            'id' => 'required|numeric',
            'producto' => 'required|string|min:2|max:30',
            'codigoProducto' => 'required|string|min:2|max:30',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'categorias_id' => 'required|numeric',
            'marcas_id' => 'required|numeric',
        ]);

        $producto = Producto::find($request->id);
        $producto->producto = $request->producto;
        $producto->codigoProducto = $request->codigoProducto;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categorias_id = $request->categorias_id;
        $producto->marcas_id = $request->marcas_id;


        $producto->save();

        return $producto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return $producto;
    }

    public function productoFilter($query = null)
    {
        if (!empty($query)) {

            $productos = Producto::leftJoin('categorias', 'productos.categorias_id', '=', 'categorias.id')
                ->leftJoin('marcas', 'productos.marcas_id', '=', 'marcas.id')
                ->where('categorias_id', '=', "$query")
                ->select('productos.*', 'marcas.marca', 'categorias.categoria')
                ->orderBy('id', 'ASC')
                ->paginate(10);
        } else {
            $productos = Producto::leftJoin('categorias', 'productos.categorias_id', '=', 'categorias.id')
                ->leftJoin('marcas', 'productos.marcas_id', '=', 'marcas.id')
                ->select('productos.*', 'marcas.marca', 'categorias.categoria')
                ->orderBy('id', 'ASC')
                ->paginate(10);
        }

        return $productos;
    }
}
