<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserIsProfessor
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'professor') {
            return redirect('/login');
        }
        return $next($request);
    }
}
