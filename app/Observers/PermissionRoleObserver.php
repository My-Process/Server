<?php

namespace App\Observers;

use App\Models\PermissionRole;
use App\Traits\Observers\RefreshPermissionCache;

class PermissionRoleObserver
{
    use RefreshPermissionCache;

    /**
     * Handle the PermissionRole "created" event.
     */
    public function created(PermissionRole $permissionRole): void
    {
        $this->forgetCachePermissionsRoles();
    }

    /**
     * Handle the PermissionRole "updated" event.
     */
    public function updated(PermissionRole $permissionRole): void
    {
        $this->forgetCachePermissionsRoles();
    }

    /**
     * Handle the PermissionRole "deleted" event.
     */
    public function deleted(PermissionRole $permissionRole): void
    {
        $this->forgetCachePermissionsRoles();
    }
}
