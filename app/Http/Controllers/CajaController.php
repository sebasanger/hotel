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
            return Caja::where('id','>','6')->orderBy('id', 'desc')->get();
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
}
