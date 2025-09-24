<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // For demo purposes, we'll use a simple check
        // In a real application, you would implement proper admin authentication
        if (!Session::has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}