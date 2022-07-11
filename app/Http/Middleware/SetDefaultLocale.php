<?php

namespace App\Http\Middleware;

use App\Enums\Global\LocaleEnum;
use App\Traits\API\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class SetDefaultLocale
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->locale ?? config('localized.default');

        $locales = collect(LocaleEnum::getValues());

        if (!$locales->contains($locale)) {
            return $request->expectsJson() ? $this->notFoundResponse() : abort(Response::HTTP_NOT_FOUND);
        }

        app()->setLocale($locale);

        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
