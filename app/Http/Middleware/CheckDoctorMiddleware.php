<?php

namespace App\Http\Middleware;

use Closure;

class CheckDoctorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 2) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
