<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class CanI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permiso)
    {
        // if(Auth::user()->can($permiso))
            
        return $next($request);
    }
}
