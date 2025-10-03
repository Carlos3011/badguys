<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Accepts roles as pipe-separated string, eg: role:admin|manager
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $roleList = collect(explode('|', $roles))->map(fn($r) => trim($r))->filter();

        $allowed = $roleList->contains(function ($role) use ($user) {
            return method_exists($user, 'hasRole') && $user->hasRole($role);
        });

        if (!$allowed) {
            abort(403, 'This action is unauthorized.');
        }

        return $next($request);
    }
}