<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        //midleware para ver si el usuario tiene el rol que le asignamos como segundo parametro cuando declaramos el middleware, ejemplo role:admin\\
        if ($request->user()->role != $role) {


            abort(403, "No tienes autorización para ingresar");
        }

        return $next($request);
    }
}
