<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cache::flush();

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            PermissionRoleSeeder::class,
        ]);

        if (!app()->environment('production', 'testing')) {
            $this->call([
                UserSeeder::class,
            ]);
        }
    }
}
