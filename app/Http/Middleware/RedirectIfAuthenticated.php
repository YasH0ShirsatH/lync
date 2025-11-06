<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard('teacher')->check()) {
            return redirect('/teacher/dashboard');
        }

        if (Auth::guard('student')->check()) {
            return redirect('/student/dashboard');
        }

        return $next($request);
    }
}
