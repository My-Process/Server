<?php

namespace App\Providers;

use App\Macro\LocalizedMacro;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Laravel\Sanctum\Sanctum;
use Laravel\Telescope\Telescope;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();

        Telescope::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMacros();

        Gate::before(function (User $user, $ability) {
            if (Permission::getPermission($ability)) {
                return $user->hasPermissionTo($ability);
            }
        });

        Password::defaults(function () {
            $rule = Password::min(8);

            return $this->app->isProduction() ? $rule->symbols()->mixedCase()->numbers()->uncompromised() : $rule;
        });
    }

    /**
     * Register macros.
     *
     * @return void
     */
    public function registerMacros(): void
    {
        LocalizedMacro::register();
    }
}
