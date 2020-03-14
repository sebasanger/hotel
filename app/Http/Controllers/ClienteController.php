<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Cliente::orderBy('id', 'desc')->get();
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
            'nombre' => 'required',
            'apellido' => 'required',
           'email' => 'unique:clientes,email|nullable',
            'dni' => 'required|unique:clientes',
        ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->dni = $request->dni;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->domicilio = $request->domicilio;
        $cliente->destino = $request->destino;
        $cliente->procedencia = $request->procedencia;
        $cliente->profecion = $request->profecion;  
        
        $cliente->save();

        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $validatedData = $request->validate([
            'id' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            //'email' => [ Rule::unique('clientes')->ignore($id)],
            'dni' => 'required',
        ]);

        $cliente = cliente::find($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->dni = $request->dni;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->domicilio = $request->domicilio;
        $cliente->destino = $request->destino;
        $cliente->procedencia = $request->procedencia;
        $cliente->profecion = $request->profecion;    


        $cliente->save();

        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $cliente = Cliente::findOrFail($id);
       $cliente->delete();
       return $cliente;
    }
}
