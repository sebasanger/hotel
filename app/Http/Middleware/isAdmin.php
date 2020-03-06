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


        if ($request->user()->role != "Admin") {
            abort(403, "No tienes autorización para ingresar");
        }

        return $next($request);
    }
}
