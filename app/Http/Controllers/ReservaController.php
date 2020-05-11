<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Consumo;
use App\Pago;
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
            'pagado' => 'numeric|nullable',

        ]);
        $fechaLibre = $this->verificacion($request->habitaciones_id, $request->ingreso, $request->egreso);
        if ($fechaLibre) {
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

            if ($request->pagado >= 1) {
                $cajaId = Caja::where('cajaActiva', 1)->first();
                $caja = Caja::findOrFail($cajaId->id);
                //si fue pagado se actualiza el saldo de la caja
                $caja->saldo += $request->pagado;
                $caja->save();
                //fin parte de cajas

                //Agregado de pago en la reserva en caso de que este pagada o almenos en parte
                $pago = new Pago();
                $pago->monto = $request->pagado;
                $pago->reservas_id = $reserva->id;
                $pago->modosPagos_id = $request->modosPagos_id;
                $pago->cajas_id = $cajaId->id;
                $pago->users_id = Auth::user()->id;
                $pago->save();
                //Agregado de pago en la reserva en caso de que este pagada o almenos en parte
            }

            return $reserva->id;
        } else {
            abort(400, 'Hay una reserva en esa fecha');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservas = Reserva::find($id)->leftJoin('clientes', 'reservas.clientes_id', '=', 'clientes.id')
            ->leftJoin('habitaciones', 'reservas.habitaciones_id', '=', 'habitaciones.id')
            ->leftJoin('facturas', 'clientes.facturas_id', '=', 'facturas.id')
            ->select('reservas.*', 'habitaciones.numeroHabitacion', 'clientes.apellido', 'clientes.nombre', 'clientes.dni', 'clientes.celular', 'clientes.profecion', 'facturas.tipoFactura')
            ->where('reservas.id', '=', $id)
            ->first();

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
        $request->validate([
            'id' => 'required|numeric',
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


        $fechaLibre = $this->verificacion($request->habitaciones_id, $request->ingreso, $request->egreso, $request->id);
        if ($fechaLibre) {
            $precio = PrecioHabitacion::findOrFail($request->preciosHabitaciones_id);
            $precioDia = $precio->precioHabitacion;
            $CantidadDias = Carbon::parse($request->ingreso)->floatDiffInDays($request->egreso);
            $precioTotal = $precioDia * $CantidadDias;

            $reserva = Reserva::find($request->id);

            $totalConsumos = $this->findConsumosForReserva($request->id);

            $colorGrafica = $this->checkColor($reserva->pagado, $precioTotal);


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
            $reserva->precio = $precioDia;
            $reserva->totalPagar = $precioTotal + $totalConsumos;
            $reserva->color = $colorGrafica;
            $reserva->users_id = Auth::user()->id;
            $reserva->save();

            return $reserva;
        } else {
            abort(400, 'Hay una reserva en esa fecha');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return $reserva;
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

    public function findPagosForReserva($reservaId)
    {
        $TotalPago = Pago::all()->where('reservas_id', $reservaId)->sum('monto');
        return $TotalPago;
    }


    public function findConsumosForReserva($reservaId)
    {
        $TotalConsumo = Consumo::all()->where('reservas_id', $reservaId)->sum('precio');
        return $TotalConsumo;
    }

    public function verificacion($habitacionId, $ingreso, $egreso, $reservaId = null)
    {
        //se pasan a carbon para hacer la comparacion en el between als fechas y al ingreso se le agrega un dia
        $from = Carbon::parse($ingreso)->addDay()->startOfDay()->toDateTimeString();
        $to = Carbon::parse($egreso)->startOfDay()->toDateTimeString();
        //se hace las comparacion y si encuentra una coincidencia suma un contador
        $onIngreso = Reserva::all()
            ->where('habitaciones_id', $habitacionId)
            ->whereNotIn('id', $reservaId)
            ->whereBetween('ingreso', [$from, $to])
            ->count();
        $onEgreso = Reserva::all()
            ->where('habitaciones_id', $habitacionId)
            ->whereNotIn('id', $reservaId)
            ->whereBetween('egreso', [$from, $to])
            ->count();
        //se suman ambos contadores
        $catidadReservas = $onIngreso + $onEgreso;
        //si el contador da 1 o mas significa que hay una reserva en esa fecha y en esa habitacion por lo que retorna un false
        if ($catidadReservas == 0) {
            return true;
        } else {
            return false;
        }
    }
}
