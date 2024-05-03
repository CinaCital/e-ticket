<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //middleware admin
        if (Auth::check() && Auth::user()->role == 'admin') {   
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'maskapai') {   
            return $next($request);
        }

        return redirect()->back()->with('403', 'Unathorized');
    }
}
