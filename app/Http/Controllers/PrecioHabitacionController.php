<?php

namespace App\Http\Controllers;

use App\PrecioHabitacion;
use Illuminate\Http\Request;

class PrecioHabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PrecioHabitacion::paginate(10);
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
            'precioHabitacion' => 'required|numeric',
            'descripcion' => 'required|string',
        ]);

        $precio = new PrecioHabitacion();
        $precio->precioHabitacion = $request->precioHabitacion;
        $precio->descripcion = $request->descripcion;
        $precio->save();

        return $precio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrecioHabitacion  $precioHabitacion
     * @return \Illuminate\Http\Response
     */
    public function show(PrecioHabitacion $precioHabitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrecioHabitacion  $precioHabitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrecioHabitacion $precioHabitacion)
    {
        $request->validate([
            'id' => 'required',
            'precioHabitacion' => 'required|numeric',
            'descripcion' => 'required|string'
        ]);

        $precio = PrecioHabitacion::find($request->id);
        $precio->precioHabitacion = $request->precioHabitacion;
        $precio->descripcion = $request->descripcion;
        $precio->save();

        return $precio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrecioHabitacion  $precioHabitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $precio = PrecioHabitacion::findOrFail($id);
        $precio->delete();
        return $precio;
    }
    public function getAllPreciosHabitaciones()
    {
        return PrecioHabitacion::orderBy('precioHabitacion')->get();
    }
}
