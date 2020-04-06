<?php

namespace App\Http\Controllers;

use App\ModoPago;
use Illuminate\Http\Request;

class ModoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ModoPago::paginate(10);
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
            'modoPago' => 'required|string|min:2|max:30|unique:modosPagos,modoPago',
            'cantidadPagos' => 'required|numeric',
        ]);

        $modoPago = new ModoPago();
        $modoPago->modoPago = $request->modoPago;
        $modoPago->cantidadPagos = $request->cantidadPagos;
        $modoPago->descripcion = $request->descripcion;
        $modoPago->save();

        return $modoPago;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModoPago  $modoPago
     * @return \Illuminate\Http\Response
     */
    public function show(ModoPago $modoPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModoPago  $modoPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModoPago $modoPago)
    {
        $request->validate([
            'id' => 'required',
            'modoPago' => 'required|string|min:2|max:30',
            'cantidadPagos' => 'required|numeric',
        ]);

        $modoPago = ModoPago::find($request->id);
        $modoPago->modoPago = $request->modoPago;
        $modoPago->cantidadPagos = $request->cantidadPagos;
        $modoPago->descripcion = $request->descripcion;
        $modoPago->save();

        return $modoPago;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModoPago  $modoPago
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modoPago = ModoPago::findOrFail($id);
        $modoPago->delete();
        return $modoPago;
    }
}
