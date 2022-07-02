<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect(config('permissions.permissions'));

        $permissions->map(function ($permission) {
            Permission::updateOrCreate(
                ['scope' => $permission['scope'], 'name' => $permission['name']],
                ['slug' => Str::slug($permission['scope'].' '.$permission['name'])]
            );
        });
    }
}
