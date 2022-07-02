<?php

namespace App\Traits\Models;

use App\Models\Permission;
use App\Models\PermissionRole;

trait HasPermissions
{
    public function getPermissions()
    {
        $rolePermissions = PermissionRole::getRolePermissions($this);

        return $rolePermissions->map(fn ($rolePermission) => Permission::getPermission($rolePermission->permission_id))->values();
    }

    public function hasPermissionTo(int|string $permission): bool
    {
        $permission = Permission::getPermission($permission);

        $rolePermissions = PermissionRole::getRolePermissions($this);

        return $rolePermissions->where('permission_id', $permission?->id)->isNotEmpty();
    }

    public function hasAnyPermission(array $permissions): bool
    {
        return collect($permissions)->map(fn ($permission) => $this->hasPermissionTo($permission))->contains(true);
    }

    public function hasAllPermissions(array $permissions): bool
    {
        return !collect($permissions)->map(fn ($permission) => $this->hasPermissionTo($permission))->contains(false);
    }

    public function assignPermissionTo(int|string $permission): void
    {
        $permission = Permission::getPermission($permission);

        $this->permissions()->syncWithoutDetaching([$permission->id]);
    }

    public function revokePermissionTo(int|string $permission): void
    {
        $permission = Permission::getPermission($permission);

        $this->permissions()->detach($permission->id);
    }

    public function syncPermissions(array $permissions): void
    {
        $permissions = collect($permissions)->map(fn ($permission) => Permission::getPermission($permission))->pluck('id');

        $this->permissions()->sync($permissions);
    }
}
