<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Cek apakah user punya salah satu role yang diizinkan.
     *
     * Contoh pemakaian di route:
     *   ->middleware('role:admin')
     *   ->middleware('role:pelanggan')
     *   ->middleware('role:admin,pelanggan')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // Kalau belum login atau role tidak ada di daftar $roles -> tolak
        if (!$user || !in_array($user->role, $roles)) {
            return redirect()
                ->route('home')
                ->with('error', 'Akses ditolak! Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}
