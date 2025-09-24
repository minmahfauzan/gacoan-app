<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class TableAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('table_id')) {
            return redirect()->route('table.access.form')->with('error', 'Please enter your table number to continue.');
        }

        return $next($request);
    }
}