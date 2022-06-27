<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!app()->environment('production', 'testing')) {
            $this->call([
                UserSeeder::class,
            ]);
        }
    }
}
