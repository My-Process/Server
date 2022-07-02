<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect(config('permissions.roles'));

        $roles->map(function ($role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                ['slug' => Str::slug($role['name']), 'description' => $role['description']]
            );
        });
    }
}
