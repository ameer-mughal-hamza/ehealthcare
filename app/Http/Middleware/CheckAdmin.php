<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 1) {
            return redirect('login');
        }
        return $next($request);
    }
}
