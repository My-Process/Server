<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermissionRole::truncate();

        $roles = Role::getAllFromCache();

        $permissions = Permission::getAllFromCache()->pluck('id');

        $roles->each(function (Role $role) use ($permissions) {
            $role->permissions()->sync($permissions);
        });
    }
}
