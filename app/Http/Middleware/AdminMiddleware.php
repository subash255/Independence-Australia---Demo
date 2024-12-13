<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user()->role !== 'admin') {
            // If not an admin, redirect to the home page
            return redirect('welcome');
        }

        // Allow request to pass if the user is an admin
        return $next($request);
    }
}
