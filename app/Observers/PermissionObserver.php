<?php

namespace App\Observers;

use App\Models\Permission;
use App\Traits\Observers\RefreshPermissionCache;

class PermissionObserver
{
    use RefreshPermissionCache;

    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        $this->forgetCachePermissions();
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        $this->forgetCachePermissions();
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        $this->forgetCachePermissions();
    }
}
