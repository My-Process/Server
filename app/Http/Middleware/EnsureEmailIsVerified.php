<?php

namespace App\Http\Middleware;

use App\Traits\API\ApiResponse;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerified
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (!$request->user() || ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                ? $this->conflictResponse(trans('auth.not-verified'))
                : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        return $next($request);
    }
}
