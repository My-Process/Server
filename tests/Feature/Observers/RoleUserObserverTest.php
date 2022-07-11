<?php

namespace Tests\Feature\Observers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RoleUserObserverTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /** @test **/
    public function it_should_should_clear_roles_cache_when_trigger_create_event(): void
    {
        $this->assertNull(Cache::get('roles::users'));

        RoleUser::getAllFromCache();

        $this->assertNotNull(Cache::get('roles::users'));

        $user = User::factory()->create();

        $roles = Role::getAllFromCache()->pluck('id');

        $user->roles()->sync($roles);

        $this->assertNull(Cache::get('roles::users'));
    }

    /** @test **/
    public function it_should_should_clear_roles_cache_when_trigger_update_event(): void
    {
        $this->assertNull(Cache::get('roles::users'));

        RoleUser::factory(10)->create();

        RoleUser::getAllFromCache();

        $this->assertNotNull(Cache::get('roles::users'));

        $role = Role::factory()->create();

        $roleUser = RoleUser::inRandomOrder()->first();

        $roleUser->fill(['role_id' => $role->id])->save();

        $this->assertNull(Cache::get('roles::users'));
    }

    /** @test **/
    public function it_should_should_clear_roles_cache_when_trigger_delete_event(): void
    {
        $this->assertNull(Cache::get('roles::users'));

        RoleUser::factory(10)->create();

        RoleUser::getAllFromCache();

        $this->assertNotNull(Cache::get('roles::users'));

        $user = User::inRandomOrder()->first();

        $roles = Role::getAllFromCache()->pluck('id');

        $user->roles()->detach($roles);

        $this->assertNull(Cache::get('roles::users'));
    }
}
