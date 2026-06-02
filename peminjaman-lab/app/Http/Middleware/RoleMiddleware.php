<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user || !$user->role) {
            abort(403, 'Akses ditolak.');
        }

        if (!in_array($user->role->nama, $roles)) {
            abort(403, 'Akses ditolak. Role kamu tidak memiliki izin.');
        }

        return $next($request);
    }
}
