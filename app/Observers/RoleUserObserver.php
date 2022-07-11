<?php

namespace App\Observers;

use App\Models\RoleUser;
use App\Traits\Observers\RefreshPermissionCache;

class RoleUserObserver
{
    use RefreshPermissionCache;

    /**
     * Handle the RoleUser "created" event.
     */
    public function created(RoleUser $roleUser): void
    {
        $this->forgetCacheRolesUsers();
    }

    /**
     * Handle the RoleUser "updated" event.
     */
    public function updated(RoleUser $roleUser): void
    {
        $this->forgetCacheRolesUsers();
    }

    /**
     * Handle the RoleUser "deleted" event.
     */
    public function deleted(RoleUser $roleUser): void
    {
        $this->forgetCacheRolesUsers();
    }
}
