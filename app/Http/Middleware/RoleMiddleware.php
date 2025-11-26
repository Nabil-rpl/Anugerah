<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Jika role tidak sesuai
        if (Auth::user()->role !== $role) {
            return abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
