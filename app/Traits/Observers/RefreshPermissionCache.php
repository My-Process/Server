<?php

namespace App\Traits\Observers;

use Illuminate\Support\Facades\Cache;

trait RefreshPermissionCache
{
    /**
     * Remove roles from Cache
     */
    public function forgetCacheRoles(): void
    {
        Cache::forget('roles');
    }

    /**
     * Remove permissions from Cache
     */
    public function forgetCachePermissions(): void
    {
        Cache::forget('permissions');
    }

    /**
     * Remove user roles from Cache
     */
    public function forgetCacheRolesUsers(): void
    {
        Cache::forget('roles::users');
    }

    /**
     * Remove role permissions from Cache
     */
    public function forgetCachePermissionsRoles(): void
    {
        Cache::forget('permissions::roles');
    }
}
