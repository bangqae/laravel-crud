<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 
     * Daftarkan CheckRole di app\Http\Kernel.php
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (in_array($request->user()->role,$roles)) {
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
