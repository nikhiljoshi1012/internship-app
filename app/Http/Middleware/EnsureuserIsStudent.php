<?php
// app/Http/Middleware/EnsureUserIsStudent.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureUserIsStudent
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'student') {
            Log::info('User role is not student', ['role' => Auth::check() ? Auth::user()->role : 'guest']);
            return redirect('/login');
        }
        Log::info('User role is student', ['role' => Auth::user()->role]);
        return $next($request);
    }
}
