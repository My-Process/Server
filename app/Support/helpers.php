<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
