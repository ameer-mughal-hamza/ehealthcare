<?php

namespace App\Http\Middleware;

use Closure;

class CheckPatientMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 3) {
            return redirect('login');
        }
        return $next($request);
    }
}
