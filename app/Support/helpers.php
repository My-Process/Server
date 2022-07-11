<?php

use App\Enums\Global\LocaleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

if (!function_exists('user')) {
    function user(): User|null
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return null;
    }
}

if (!function_exists('collectEloquent')) {
    function collectEloquent(): Collection
    {
        return new Collection();
    }
}

if (!function_exists('setLocaleHost')) {
    function setLocaleHost(): void
    {
        $locale = Str::of(request()->getHost())->explode('.')->get(0);

        $locales = collect(LocaleEnum::getValues());

        $setLocale = $locales->contains($locale) ? $locale : config('localized.default');

        app()->setLocale($setLocale);
    }
}
