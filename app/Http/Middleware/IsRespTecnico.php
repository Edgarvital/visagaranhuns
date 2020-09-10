<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsRespTecnico
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( !auth()->check() )
            return redirect()->route('login');

        if (Auth::user()->tipo == "rt"){
            return $next($request);
        }
        abort(403);
        // return $next($request);
    }
}
