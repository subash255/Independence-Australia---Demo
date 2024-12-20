<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has either 'admin' or 'superadmin' role
        if (Auth::check() && !in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            // If not an admin or superadmin, redirect to the welcome page
            return redirect('/');
        }

        // Allow request to pass if the user has 'admin' or 'superadmin' role
        return $next($request);
    }
}
