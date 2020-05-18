<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Movimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
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
            'modosPagos_id' => 'required|numeric',
            'cajas_id' => 'required|numeric',
            'tipo' => 'required|numeric',
            'descripcion' => 'required|string',
        ]);

        $movimiento = new Movimiento();
        $movimiento->tipo = $request->tipo;
        $movimiento->monto = $request->monto;
        $movimiento->descripcion = $request->descripcion;
        $movimiento->modosPagos_id = $request->modosPagos_id;
        $movimiento->cajas_id = $request->cajas_id;
        $movimiento->users_id = Auth::user()->id;


        $caja = Caja::findOrFail($request->cajas_id);
        if ($request->tipo == 1) {
            $caja->saldo += $request->monto;
        } elseif ($request->tipo == 0) {
            $caja->saldo -= $request->monto;
        }
        $caja->save();

        $movimiento->save();

        return $movimiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Movimiento $movimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimiento $movimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        $caja = Caja::findOrFail($movimiento->cajas->id);
        if ($movimiento->tipo == 1) {
            $caja->saldo -= $movimiento->monto;
        } elseif ($movimiento->tipo == 0) {
            $caja->saldo += $movimiento->monto;
        }
        $caja->save();
        $movimiento->delete();
        return $movimiento;
    }

    public function getIngresos($cajaId)
    {
        $movimiento = Movimiento::leftJoin('users', 'movimientos.users_id', '=', 'users.id')
            ->leftJoin('modosPagos', 'movimientos.modosPagos_id', '=', 'modosPagos.id')
            ->select('movimientos.*', 'users.name', 'modosPagos.modoPago')
            ->where('movimientos.tipo', "=", 1)
            ->where('movimientos.cajas_id', $cajaId)
            ->latest()
            ->get();
        return $movimiento;
    }

    public function getEgresos($cajaId)
    {
        $movimiento = Movimiento::leftJoin('users', 'movimientos.users_id', '=', 'users.id')
            ->leftJoin('modosPagos', 'movimientos.modosPagos_id', '=', 'modosPagos.id')
            ->select('movimientos.*', 'users.name', 'modosPagos.modoPago')
            ->where('movimientos.tipo', "=", 0)
            ->where('movimientos.cajas_id', $cajaId)
            ->latest()
            ->get();
        return $movimiento;
    }

    public function getIngresosDiarios()
    {
        $ingresos = Movimiento::where('created_at', '>=', Carbon::now()->subWeeks(2))
            ->select(
                DB::raw('Date(created_at) as date'),
                'tipo',
                DB::raw('SUM(monto) as "total"'),
            )
            ->groupBy(['date', 'tipo'])
            ->orderBy('created_at', 'ASC')
            ->get();


        return $ingresos;
    }

    public function getEgresosDiarios()
    {
        $ingresos = Movimiento::where('created_at', '>=', Carbon::now()->subWeeks(2))
            ->select(
                DB::raw('Date(created_at) as date'),
                'tipo',
                DB::raw('SUM(monto) as "total"'),
            )
            ->groupBy(['date', 'tipo'])
            ->orderBy('created_at', 'ASC')
            ->get();


        return $ingresos;
    }
}
