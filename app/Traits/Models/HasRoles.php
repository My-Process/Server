<?php

namespace App\Traits\Models;

use App\Models\Role;
use App\Models\RoleUser;

trait HasRoles
{
    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    public function getRoles()
    {
        $userRoles = RoleUser::getUserRoles($this);

        return $userRoles->map(fn ($userRole) => Role::getRole($userRole->role_id))->values();
    }

    public function hasRoleTo(int|string $role): bool
    {
        $role = Role::getRole($role);

        $userRoles = RoleUser::getUserRoles($this);

        return $userRoles->where('role_id', $role?->id)->isNotEmpty();
    }

    public function hasAnyRole(array $roles): bool
    {
        return collect($roles)->map(fn ($role) => $this->hasRoleTo($role))->contains(true);
    }

    public function hasAllRoles(array $roles): bool
    {
        return !collect($roles)->map(fn ($role) => $this->hasRoleTo($role))->contains(false);
    }

    public function assignRoleTo(int|string $role): void
    {
        $role = Role::getRole($role);

        $this->roles()->syncWithoutDetaching([$role->id]);
    }

    public function revokeRoleTo(int|string $role): void
    {
        $role = Role::getRole($role);

        $this->roles()->detach($role->id);
    }

    public function syncRoles(array $roles): void
    {
        $roles = collect($roles)->map(fn ($role) => Role::getRole($role))->pluck('id');

        $this->roles()->sync($roles);
    }

    /*
    |--------------------------------------------------------------------------
    | Permission via Roles
    |--------------------------------------------------------------------------
    */

    public function getPermissions()
    {
        $permissions = collectEloquent();

        $roles = $this->getRoles();

        $roles->each(function ($role) use (&$permissions) {
            $permissions = $permissions->merge($role->getPermissions());
        });

        return $permissions->unique()->values();
    }

    public function hasPermissionTo(int|string $permission): bool
    {
        $roles = $this->getRoles();

        return $roles->map(fn ($role) => $role->hasPermissionTo($permission))->contains(true);
    }

    public function hasAnyPermission(array $permissions): bool
    {
        $roles = $this->getRoles();

        return $roles->map(fn ($role) => $role->hasAnyPermission($permissions))->contains(true);
    }

    public function hasAllPermissions(array $permissions): bool
    {
        $roles = $this->getRoles();

        return !collect($permissions)->map(function ($permission) use ($roles) {
            return $roles->map(fn ($role) => $role->hasPermissionTo($permission))->contains(true);
        })->contains(false);
    }
}
