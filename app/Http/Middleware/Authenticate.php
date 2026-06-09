<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        // Izinkan akses untuk login dan register
        if ($request->is('login') || $request->is('register') || $request->is('/')) {
            return $next($request);
        }

        // Cek apakah user belum login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}