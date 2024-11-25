<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }

        if ($user->role != $role) {
            return response()->json(['error' => 'Unauthorized. You do not have access to this resource'], 403);
        }

        return $next($request);
    }
}
