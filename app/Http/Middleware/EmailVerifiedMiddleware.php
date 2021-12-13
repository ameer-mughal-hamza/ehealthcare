<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmailVerifiedMiddleware
{
    public function handle($request, Closure $next)
    {
        dd('asad');
        if (!auth()->user()->is_verified) {
            session()->flash('verify_account', 'Please verify your account.');
            session()->flash('verify_account_email', Auth::user()->email);
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
