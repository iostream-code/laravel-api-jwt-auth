<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            return response()->json(['message' => 'You cannot access this page! You are not an ' . $role]);
        }

        return $next($request);
    }
}
