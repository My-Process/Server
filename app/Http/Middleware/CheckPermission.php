<?php

namespace App\Http\Middleware;

use App\Traits\API\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CheckPermission
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string $permissions
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $permissions)
    {
        $permissions = Str::of($permissions)->explode('|')->toArray();

        if (!$request->user()->canAny($permissions)) {
            return $request->expectsJson() ? $this->forbiddenResponse(trans('auth.blocked')) : abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
