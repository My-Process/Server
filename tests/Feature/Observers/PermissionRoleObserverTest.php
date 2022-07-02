<?php

namespace Tests\Feature\Observers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PermissionRoleObserverTest extends TestCase
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
        $this->assertNull(Cache::get('permissions::roles'));

        PermissionRole::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions::roles'));

        $role = Role::factory()->create();

        $permissions = Permission::getAllFromCache()->pluck('id');

        $role->permissions()->sync($permissions);

        $this->assertNull(Cache::get('permissions::roles'));
    }

    /** @test **/
    public function it_should_should_clear_roles_cache_when_trigger_update_event(): void
    {
        $this->assertNull(Cache::get('permissions::roles'));

        PermissionRole::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions::roles'));

        $role = Role::factory()->create();

        $permissionRole = PermissionRole::inRandomOrder()->first();

        $permissionRole->fill(['role_id' => $role->id])->save();

        $this->assertNull(Cache::get('permissions::roles'));
    }

    /** @test **/
    public function it_should_should_clear_roles_cache_when_trigger_delete_event(): void
    {
        $this->assertNull(Cache::get('permissions::roles'));

        PermissionRole::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions::roles'));

        $role = Role::inRandomOrder()->first();

        $permissions = Permission::getAllFromCache()->pluck('id');

        $role->permissions()->detach($permissions);

        $this->assertNull(Cache::get('permissions::roles'));
    }
}
