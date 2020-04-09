<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $clientes = Cliente::leftJoin('facturas', 'clientes.facturas_id', '=', 'facturas.id')
            ->select('clientes.*', 'facturas.tipoFactura')
            ->latest()
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
            'nombre' => 'required|string|min:2|max:30',
            'apellido' => 'required|string|min:2|max:30',
            'dni' => 'required|numeric',
            'celular' => 'nullable|numeric',
            'domicilio' => 'nullable|string|min:2|max:30',
            'profecion' => 'nullable|string|min:2|max:30',
            'procedencia' => 'nullable|string|min:2|max:30',
            'destino' => 'nullable|string|min:2|max:30',

        ]);

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->dni = $request->dni;
        $cliente->celular = $request->celular;
        $cliente->domicilio = $request->domicilio;
        $cliente->destino = $request->destino;
        $cliente->procedencia = $request->procedencia;
        $cliente->profecion = $request->profecion;
        $cliente->facturas_id = $request->facturas_id;

        $cliente->save();

        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return cliente::findOrFail($id);
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

        $request->validate([
            'id' => 'required',
            'nombre' => 'required|string|min:2|max:30',
            'apellido' => 'required|string|min:2|max:30',
            'dni' => [Rule::unique('clientes')->ignore($id)],
            'celular' => 'nullable|numeric',
            'domicilio' => 'nullable|string|min:2|max:30',
            'profecion' => 'nullable|string|min:2|max:30',
            'procedencia' => 'nullable|string|min:2|max:30',
            'destino' => 'nullable|string|min:2|max:30',
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
        $cliente->facturas_id = $request->facturas_id;


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


    public function clienteFilter($query = null)
    {
        if (!empty($query)) {
            $filter = trim(strtolower($query));
            $clientes = Cliente::leftJoin('facturas', 'clientes.facturas_id', '=', 'facturas.id')
                ->where('nombre', 'LIKE', "%$filter%")
                ->orWhere('apellido', 'LIKE', "%$filter%")
                ->orWhere('dni', 'LIKE', "%$filter%")
                ->select('clientes.*', 'facturas.tipoFactura')
                ->latest()
                ->paginate(20);
        } else {
            $clientes = Cliente::leftJoin('facturas', 'clientes.facturas_id', '=', 'facturas.id')
                ->select('clientes.*', 'facturas.tipoFactura')
                ->latest()
                ->paginate(10);
        }

        return $clientes;
    }
}
