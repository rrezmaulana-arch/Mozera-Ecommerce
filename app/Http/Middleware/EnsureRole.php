<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('admin.login');
        }

        // 'owner' has full access to all admin zones
        if ($user->role === 'owner') {
            return $next($request);
        }

        // Check if user's role matches any allowed roles
        if (in_array($user->role, $roles, true)) {
            return $next($request);
        }

        // Forbidden
        abort(403, 'Akses Ditolak: Peran akun Anda (' . ($user->role ?? 'tamu') . ') tidak memiliki wewenang untuk membuka modul ini.');
    }
}

