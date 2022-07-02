<?php

namespace App\Observers;

use App\Models\Role;
use App\Traits\Observers\RefreshPermissionCache;

class RoleObserver
{
    use RefreshPermissionCache;

    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        $this->forgetCacheRoles();
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        $this->forgetCacheRoles();
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        $this->forgetCacheRoles();
    }
}
