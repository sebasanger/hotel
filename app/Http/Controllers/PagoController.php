<?php

namespace App\Http\Controllers;

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
        $nuevoPagado = $reserva->pagado - $pago->monto;
        if ($nuevoPagado >= $reserva->totalPagar) {
            $reserva->color = "green";
        } else {
            $reserva->color = "red";
        }
        //reduccion de la cantidad pagada de la reserva
        $reserva->pagado = $nuevoPagado;
        $reserva->save();
        $pago->delete();
        return $pago;
    }

    public function getPagosByReserva($reservaId)
    {
        $pago = Pago::leftJoin('users', 'pagos.users_id', '=', 'users.id')
            ->leftJoin('modosPagos', 'pagos.modosPagos_id', '=', 'modosPagos.id')
            ->where('reservas_id', $reservaId)
            ->select('pagos.*', 'users.name', 'modosPagos.modoPago')
            ->latest()
            ->get();
        return $pago;
    }
}
