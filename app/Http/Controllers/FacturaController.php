<?php

namespace App\Http\Controllers;

use App\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Factura::paginate(10);
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
            'tipoFactura' => 'required|string|min:2|max:30|unique:facturas,tipoFactura',
        ]);

        $factura = new Factura();
        $factura->tipoFactura =  $request->tipoFactura;
        $factura->save();

        return $factura;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tipoFactura' => 'required|string|min:2|max:30',
        ]);

        $factura = Factura::find($request->id);
        $factura->tipoFactura = $request->tipoFactura;
        $factura->save();

        return $factura;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();
        return $factura;
    }
}
