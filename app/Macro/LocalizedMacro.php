<?php

namespace App\Macro;

use Illuminate\Support\Facades\Route;

class LocalizedMacro
{
    /**
     * Register the macro.
     */
    public static function register(): void
    {
        Route::macro('localized', function ($callback) {
            Route::domain('{locale}.localhost')->group($callback);

            Route::group([], $callback);
        });
    }
}
