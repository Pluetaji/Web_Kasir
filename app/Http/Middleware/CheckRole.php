<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRole = strtolower(auth()->user()->role ?? '');
        $requiredRole = strtolower($role);

        // Jika user adalah Kasir dan mencoba masuk ke rute Manager, tolak!
        if ($userRole === 'kasir' && $requiredRole === 'manager') {
            return redirect('/kasir');
        }

        // Manager memiliki akses universal, jadi jika userRole adalah Manager,
        // mereka selalu diizinkan melewati middleware ini terlepas dari $role parameter.

        return $next($request);
    }
}
