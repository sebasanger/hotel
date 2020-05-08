<?php

namespace App\Http\Controllers;

use App\Consumo;
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
            'modosPagos_id' => 'required|numeric',
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
    public function destroy(Consumo $consumo)
    {
        //
    }

    public function getConsumosByReserva($reservaId)
    {
        $consumo = Consumo::leftJoin('users', 'consumos.users_id', '=', 'users.id')
            ->leftJoin('productos', 'consumos.productos_id', '=', 'productos.id')
            ->leftJoin('modosPagos', 'consumos.modosPagos_id', '=', 'modosPagos.id')
            ->where('reservas_id', $reservaId)
            ->select('consumos.*', 'users.name', 'modosPagos.modoPago', 'productos.producto')
            ->latest()
            ->get();
        return $consumo;
    }
}
