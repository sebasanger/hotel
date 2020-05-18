<?php

namespace App\Http\Controllers;

use App\Caja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{

    /*public function __construct(){

        $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    */

    public function index($query = null)
    {
        if (empty($query)) {
            $cajas = Caja::leftJoin('users', 'cajas.users_id', '=', 'users.id')
                ->select('cajas.*', 'users.name')
                ->latest()
                ->paginate(10);
        } else {
            $cajas = Caja::leftJoin('users', 'cajas.users_id', '=', 'users.id')
                ->select('cajas.*', 'users.name')
                ->where('cajas.users_id', '=', $query)
                ->latest()
                ->paginate(10);
        }

        return $cajas;
    }


    public function store(Request $request)
    {
        $request->validate([
            'montoApertura' => 'required|numeric|min:1',
        ]);

        $cajaActiva = Caja::where('cajaActiva', 1)->first();
        if ($cajaActiva) {
            abort(400, "Ya hay una caja activa");
        } else {
            $caja = new Caja();
            $caja->montoApertura = $request->montoApertura;
            $caja->cajaActiva = 1;
            $caja->saldo = $request->montoApertura;
            $caja->users_id = Auth::user()->id;
            $caja->save();

            return $caja;
        }
    }

    public function getCajaData($id)
    {
        $caja = Caja::where('cajas.id',  $id)->leftJoin('users', 'cajas.users_id', '=', 'users.id')
            ->select('cajas.*', 'users.name')->first();

        return $caja;
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'montoCierre' => 'required|numeric|min:1',
        ]);

        $cajaActiva = Caja::findOrFail($id);
        if ($cajaActiva->cajaActiva != 1) {
            abort(400, "No hay caja activa");
        } else {
            $cajaActiva->montoCierre = $request->montoCierre;
            $cajaActiva->cajaActiva = 0;
            $cajaActiva->horaCierre = Carbon::now();

            $cajaActiva->save();

            return $cajaActiva;
        }
    }


    public function destroy($id)
    {
        $caja = Caja::findOrFail($id);
        $caja->delete();
        return $caja;
    }

    public function getCajaActiva()
    {
        $caja = Caja::where('cajaActiva', 1)->leftJoin('users', 'cajas.users_id', '=', 'users.id')
            ->select('cajas.*', 'users.name')->first();
        if ($caja) {
            return $caja;
        } else {
            return null;
        }
    }

    public function getSaldosDiarios()
    {
        $saldos = Caja::where('created_at', '>=', Carbon::now()->subWeeks(2))
            ->select(
                DB::raw('Date(created_at) as date'),
                DB::raw('SUM(saldo) as "total"'),
            )
            ->groupBy(['date'])
            ->orderBy('created_at', 'ASC')
            ->get();


        return $saldos;
    }
}
