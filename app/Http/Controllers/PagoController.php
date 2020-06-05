<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Pago;
use App\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'monto' => 'required|numeric|min:1',
            'reservas_id' => 'required|numeric',
            'modosPagos_id' => 'required|numeric',
            'cajas_id' => 'required|numeric',

        ]);

        $pago = new Pago();
        $pago->monto = $request->monto;
        $pago->reservas_id = $request->reservas_id;
        $pago->modosPagos_id = $request->modosPagos_id;
        $pago->cajas_id = $request->cajas_id;
        $pago->users_id = Auth::user()->id;

        //actualizacion del color en la tabla de reservas
        $reserva = Reserva::findOrFail($request->reservas_id);
        if ($reserva->pagado + $request->monto >= $reserva->totalPagar) {
            $reserva->color = "green";
        } else {
            $reserva->color = "red";
        }
        //actualizacion de total pagado de la reserva
        $reserva->pagado += $request->monto;
        $reserva->save();
        //fin parte de reservas

        //sumando al saldo de la caja
        $caja = Caja::findOrFail($request->cajas_id);
        $caja->saldo += $request->monto;
        $caja->save();
        //sumando al saldo de la caja

        $pago->save();

        return $pago;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        //revision del color de la grafica
        $reserva = Reserva::findOrFail($pago->reservas->id);
        if ($reserva->estado == 0) {
            abort(400, 'No se puede eliminar el pago de una reserva finalizada');
        }
        $nuevoPagado = $reserva->pagado - $pago->monto;
        if ($nuevoPagado >= $reserva->totalPagar) {
            $reserva->color = "green";
        } else {
            $reserva->color = "red";
        }
        //reduccion de la cantidad pagada de la reserva
        $reserva->pagado = $nuevoPagado;
        $reserva->save();
        //reduccion de la cantidad pagada de la reserva

        //reduccion del saldo de la caja
        $caja = Caja::findOrFail($pago->cajas->id);
        $caja->saldo -= $pago->monto;
        $caja->save();
        //reduccion del saldo de la caja

        $pago->delete();
        return $pago;
    }

    public function getPagosByReserva($reservaId)
    {
        $pago = Pago::leftJoin('users', 'pagos.users_id', '=', 'users.id')
            ->leftJoin('modospagos', 'pagos.modosPagos_id', '=', 'modospagos.id')
            ->select('pagos.*', 'users.name', 'modospagos.modoPago')
            ->where('pagos.reservas_id', $reservaId)
            ->latest()
            ->get();
        return $pago;
    }

    public function getPagosByCaja($cajaId)
    {
        $pago = Pago::leftJoin('users', 'pagos.users_id', '=', 'users.id')
            ->leftJoin('modospagos', 'pagos.modosPagos_id', '=', 'modospagos.id')
            ->leftJoin('reservas', 'pagos.reservas_id', '=', 'reservas.id')
            ->leftJoin('clientes', 'reservas.clientes_id', '=', 'clientes.id')
            ->leftJoin('habitaciones', 'reservas.habitaciones_id', '=', 'habitaciones.id')
            ->select('pagos.*', 'users.name', 'modospagos.modoPago', 'reservas.estado', 'clientes.nombre', 'clientes.apellido', 'habitaciones.numeroHabitacion')
            ->where('pagos.cajas_id', $cajaId)
            ->latest()
            ->get();
        return $pago;
    }
}
