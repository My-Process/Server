<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        // $authGuard = app('auth')->guard($guard);

        // if ($authGuard->guest()) {
        //     throw UnauthorizedException::notLoggedIn();
        // }

        // $permissions = is_array($permission)
        //     ? $permission
        //     : explode('|', $permission);

        // foreach ($permissions as $permission) {
        //     if ($authGuard->user()->can($permission)) {
        //         return $next($request);
        //     }
        // }

        // throw UnauthorizedException::forPermissions($permissions);
    }
}
