<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\PrecioHabitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::leftJoin('clientes', 'reservas.clientes_id', '=', 'clientes.id')
            ->leftJoin('habitaciones', 'reservas.habitaciones_id', '=', 'habitaciones.id')
            ->select('reservas.*', 'habitaciones.numeroHabitacion', 'clientes.apellido', 'clientes.nombre')
            ->get();

        return $reservas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'huespedes' => 'required|numeric',
            'ingreso' => 'date|required',
            'egreso' => 'date|required',
            'clientes_id' => 'required|numeric',
            'habitaciones_id' => 'required|numeric',
            'preciosHabitaciones_id' => 'required|numeric',
            'motivos_id' => 'nullable|numeric',
            'destino' => 'string|nullable',
            'procedencia' => 'string|nullable',

        ]);

        $precio = PrecioHabitacion::findOrFail($request->preciosHabitaciones_id);
        $precioDia = $precio->precioHabitacion;
        $CantidadDias = Carbon::parse($request->ingreso)->floatDiffInDays($request->egreso);
        $precioTotal = $precioDia * $CantidadDias;

        $colorGrafica = $this->checkColor($request->pagado, $precioTotal);

        $reserva = new Reserva();
        $reserva->huespedes = $request->huespedes;
        $reserva->ingreso = $request->ingreso;
        $reserva->egreso = $request->egreso;
        $reserva->clientes_id = $request->clientes_id;
        $reserva->habitaciones_id = $request->habitaciones_id;
        $reserva->preciosHabitaciones_id = $request->preciosHabitaciones_id;
        $reserva->motivos_id = $request->motivos_id;
        $reserva->patenteAuto = $request->patenteAuto;
        $reserva->destino = $request->destino;
        $reserva->procedencia = $request->procedencia;
        $reserva->pagado = $request->pagado;
        $reserva->precio = $precioDia;
        $reserva->totalPagar = $precioTotal;
        $reserva->color = $colorGrafica;
        $reserva->users_id = Auth::user()->id;
        $reserva->save();

        return $reserva;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservas = Reserva::leftJoin('clientes', 'reservas.clientes_id', '=', 'clientes.id')
            ->leftJoin('habitaciones', 'reservas.habitaciones_id', '=', 'habitaciones.id')
            ->select('reservas.*', 'habitaciones.numeroHabitacion', 'clientes.apellido', 'clientes.nombre')
            ->where('reservas.id', "=", $id)->get();

        return $reservas;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    public function checkColor($pagado, $porPagar)
    {
        $color = "blue";
        if ($pagado >= $porPagar) {
            $color = "green";
        } elseif ($pagado < $porPagar) {
            $color = "red";
        }
        return $color;
    }
}
