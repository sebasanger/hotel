<?php

namespace App\Http\Controllers;

use App\Caja;
use Illuminate\Http\Request;

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
    {
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
        $caja = Caja::where('cajaActiva', "=", 1)->first();
        if ($caja) {
            return $caja;
        } else {
            abort(404, "No hay caja activa");
        }
    }
}
