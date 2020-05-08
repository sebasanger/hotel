<?php

namespace App\Http\Controllers;

use App\Caja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{

    /*public function __construct(){

        $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Caja::all();
        } else {
            abort(403, "No permitido");
        }
    }


    public function store(Request $request)
    { {
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
    }

    public function show(Caja $caja)
    {
        //
    }


    public function update(Request $request, Caja $caja)
    {
        //
    }


    public function destroy(Caja $caja)
    {
        //
    }

    public function getCajaActiva()
    {
        $caja = Caja::where('cajaActiva', 1)->leftJoin('users', 'cajas.users_id', '=', 'users.id')
            ->select('cajas.*', 'users.name')->first();
        if ($caja) {
            return $caja;
        } else {
            abort(404, "No hay caja activa");
        }
    }
}
