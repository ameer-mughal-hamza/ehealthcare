<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
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
        if (auth()->check() && !auth()->user()->role === 1) {
            session()->flash('patient_dashboard_restrict', 'You are not allowed to access this page.');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
