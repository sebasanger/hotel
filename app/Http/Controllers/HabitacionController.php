<?php

namespace App\Http\Controllers;


use App\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Habitacion::OrderBy('numeroHabitacion', 'ASC')->paginate(15);
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
            'numeroHabitacion' => 'required|numeric|unique:habitaciones',
            'piso' => 'required|numeric|max:8',
            'capacidad' => 'required|numeric',
            'single' => 'nullable|numeric|max:6',
            'doble' => 'nullable|numeric|max:4',
            'image_path' => 'nullable|mimes:jpeg,bmp,png,jpg',
            'image_path2' => 'nullable|mimes:jpeg,bmp,png,jpg',
            'image_path3' => 'nullable|mimes:jpeg,bmp,png,jpg',

        ]);

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = $request->numeroHabitacion;
        $habitacion->piso = $request->piso;
        $habitacion->capacidad = $request->capacidad;
        $habitacion->single = $request->single;
        $habitacion->doble = $request->doble;
        $habitacion->image_path = $request->image_path;
        $habitacion->image_path2 = $request->image_path2;
        $habitacion->image_path3 = $request->image_path3;
        $habitacion->estado = 1;


        $habitacion->save();

        return $habitacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return Habitacion::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'numeroHabitacion' => [Rule::unique('habitaciones')->ignore($id)],
            'piso' => 'required|numeric|max:8',
            'capacidad' => 'required|numeric',
            'single' => 'nullable|numeric|max:6',
            'doble' => 'nullable|numeric|max:4',


        ]);

        $habitacion = Habitacion::find($request->id);
        $habitacion->numeroHabitacion = $request->numeroHabitacion;
        $habitacion->piso = $request->piso;
        $habitacion->capacidad = $request->capacidad;
        $habitacion->single = $request->single;
        $habitacion->doble = $request->doble;
        $habitacion->image_path = $request->image_path;
        $habitacion->image_path2 = $request->image_path2;
        $habitacion->image_path3 = $request->image_path3;
        $habitacion->estado = $request->estado;

        $habitacion->save();

        return $habitacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();
        return $habitacion;
    }
}
