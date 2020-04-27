<?php

namespace App\Http\Controllers;

use App\Motivo;
use Illuminate\Http\Request;

class MotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Motivo::paginate(10);
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
            'motivo' => 'required|string|min:2|max:30|unique:motivos,motivo',
        ]);

        $motivo = new Motivo();
        $motivo->motivo = $request->motivo;
        $motivo->save();

        return $motivo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function show(Motivo $motivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'motivo' => 'required|string|min:2|max:30',
        ]);

        $motivo = Motivo::find($request->id);
        $motivo->motivo = $request->motivo;
        $motivo->save();

        return $motivo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Motivo  $motivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $motivo = Motivo::findOrFail($id);
        $motivo->delete();
        return $motivo;
    }
    public function getAllMotivos()
    {
        return Motivo::all();
    }
}
