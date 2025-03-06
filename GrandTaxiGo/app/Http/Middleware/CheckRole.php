<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'vous devez vous connecter.');
        }

        if (auth()->user()->role !== $role) {
            return redirect('/')->with('error', 'Vous n\'avez pas les droits suffisants.');
        }

        return $next($request);
    }
}