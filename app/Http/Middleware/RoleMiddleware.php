<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
public function handle(Request $request, Closure $next, string $role)
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // jika admin, boleh akses semua
    if ($user->role === 'admin') {
        return $next($request);
    }

    // jika bukan admin harus sesuai role
    if ($user->role !== $role) {
        abort(403, 'Akses ditolak');
    }

    return $next($request);
}
}
