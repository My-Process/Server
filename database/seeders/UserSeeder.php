<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::getAllFromCache()->pluck('id')->toArray();

        $user = User::factory()->create(['email' => 'administrator@example.com']);

        $user->syncRoles($roles);
    }
}
