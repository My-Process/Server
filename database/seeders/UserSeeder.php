<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'email'    => config('custom.admin_email'),
            'password' => config('custom.admin_password'),
        ]);
    }
}
