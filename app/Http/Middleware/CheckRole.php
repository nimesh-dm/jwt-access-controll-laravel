<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        $user = Auth::guard('api')->user();
        
        if ($user && $user->hasRole($role) == $role) {
            return $next($request);
        }
        // return response()->json(['user' => $user->hasRole($role),'role' => $role], 201);
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
