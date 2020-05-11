<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Consumo;
use App\Pago;
use App\Producto;
use App\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsumoController extends Controller
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
            'cantidad' => 'required|numeric|min:1',
            'productos_id' => 'required|numeric',
            'reservas_id' => 'required|numeric',
            'modosPagos_id' => 'nullable|numeric',
            'cajas_id' => 'required|numeric',
            'pagado' => 'required|numeric',
        ]);

        $consumo = new Consumo();
        $consumo->cantidad = $request->cantidad;
        $consumo->productos_id = $request->productos_id;
        $consumo->reservas_id = $request->reservas_id;
        $consumo->modosPagos_id = $request->modosPagos_id;
        $consumo->cajas_id = $request->cajas_id;
        $consumo->pagado = $request->pagado;
        $consumo->users_id = Auth::user()->id;

        //actualizacion del stock del producto
        $producto = Producto::findOrFail($request->productos_id);
        $producto->stock -= $request->cantidad;

        //se saca el precio actual del producto para guardar en el consumo
        $consumo->precio = $producto->precio;

        //precio final del consumo
        $precioTotal = $producto->precio * $consumo->cantidad;

        //se guarda los cambios en el producto
        $producto->save();

        //verificacion de si se pago el consumo en el acto
        $pagado = 0;
        if ($request->pagado == 1) {
            $pagado = $precioTotal;
            //si fue pagado se actualiza el saldo de la caja
            $caja = Caja::findOrFail($request->cajas_id);
            $caja->saldo += $precioTotal;
            $caja->save();
            //fin parte de cajas

            //Agregado de pago en la reserva en caso de que este pagado el consumo
            $pago = new Pago();
            $pago->monto = $precioTotal;
            $pago->reservas_id = $request->reservas_id;
            $pago->modosPagos_id = $request->modosPagos_id;
            $pago->cajas_id = $request->cajas_id;
            $pago->users_id = Auth::user()->id;
            $pago->save();
            //Agregado de pago en la reserva en caso de que este pagado el consumo
        }

        //actualizacion del color en la tabla de reservas
        $reserva = Reserva::findOrFail($request->reservas_id);
        if ($reserva->pagado + $pagado >= $reserva->totalPagar + $precioTotal) {
            $reserva->color = "green";
        } else {
            $reserva->color = "red";
        }
        //actualizacion de total pagado de la reserva
        $reserva->totalPagar += $precioTotal;
        $reserva->pagado += $pagado;
        $reserva->save();
        //fin parte de reservas

        $consumo->save();

        return $consumo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consumo  $consumo
     * @return \Illuminate\Http\Response
     */
    public function show(Consumo $consumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consumo  $consumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consumo $consumo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consumo  $consumo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consumo = Consumo::findOrFail($id);
        //revision del color de la grafica
        $reserva = Reserva::findOrFail($consumo->reservas_id);
        $total = $consumo->precio * $consumo->cantidad;
        $nuevoTotal = $reserva->totalPagar - $total;
        if ($reserva->totalPagado >= $nuevoTotal) {
            $reserva->color = "green";
        } else {
            $reserva->color = "red";
        }
        //reduccion de la cantidad a pagar
        $reserva->totalPagar = $nuevoTotal;
        $reserva->save();
        //reduccion de la cantidad a pagar

        //aumento del stock del producto
        $producto = Producto::findOrFail($consumo->productos_id);
        $producto->stock += $consumo->cantidad;
        $producto->save();
        //aumento del stock del producto

        if ($consumo->pagado == 1) {
            //reduccion del saldo de la caja si es que esta pagadfo el consumo
            $caja = Caja::findOrFail($consumo->cajas->id);
            $caja->saldo -= $total;
            $caja->save();
            //reduccion del saldo de la caja si es que esta pagadfo el consumo
        }


        $consumo->delete();
        return $consumo;
    }

    public function getConsumosByReserva($reservaId)
    {
        $consumo = Consumo::leftJoin('users', 'consumos.users_id', '=', 'users.id')
            ->leftJoin('productos', 'consumos.productos_id', '=', 'productos.id')
            ->leftJoin('modosPagos', 'consumos.modosPagos_id', '=', 'modosPagos.id')
            ->select('consumos.*', 'users.name', 'modosPagos.modoPago', 'productos.producto')
            ->where('consumos.reservas_id', $reservaId)
            ->latest()
            ->get();
        return $consumo;
    }

    public function getConsumosByCaja($cajaId)
    {
        $consumo = Consumo::leftJoin('users', 'consumos.users_id', '=', 'users.id')
            ->leftJoin('productos', 'consumos.productos_id', '=', 'productos.id')
            ->leftJoin('modosPagos', 'consumos.modosPagos_id', '=', 'modosPagos.id')
            ->leftJoin('reservas', 'consumos.reservas_id', '=', 'reservas.id')
            ->leftJoin('clientes', 'reservas.clientes_id', '=', 'clientes.id')
            ->leftJoin('habitaciones', 'reservas.habitaciones_id', '=', 'habitaciones.id')
            ->select('consumos.*', 'users.name', 'modosPagos.modoPago', 'productos.producto', 'reservas.estado', 'clientes.nombre', 'clientes.apellido', 'habitaciones.numeroHabitacion')
            ->where('consumos.cajas_id', $cajaId)
            ->latest()
            ->get();
        return $consumo;
    }
}
