<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsStudent
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'student') {
            return redirect('/login');
        }
        return $next($request);
    }
}
