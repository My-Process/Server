<?php

namespace Tests\Feature\Traits\Observers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\RoleUser;
use App\Traits\Observers\RefreshPermissionCache;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RefreshPermissionCacheTest extends TestCase
{
    use RefreshPermissionCache;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /** @test **/
    public function it_should_remove_roles_from_cache(): void
    {
        $this->assertNull(Cache::get('roles'));

        Role::getAllFromCache();

        $this->assertNotNull(Cache::get('roles'));

        $this->forgetCacheRoles();

        $this->assertNull(Cache::get('roles'));
    }

    /** @test **/
    public function it_should_remove_permissions_from_cache(): void
    {
        $this->assertNull(Cache::get('permissions'));

        Permission::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions'));

        $this->forgetCachePermissions();

        $this->assertNull(Cache::get('permissions'));
    }

    /** @test **/
    public function it_should_remove_roles_users_from_cache(): void
    {
        $this->assertNull(Cache::get('roles::users'));

        RoleUser::getAllFromCache();

        $this->assertNotNull(Cache::get('roles::users'));

        $this->forgetCacheRolesUsers();

        $this->assertNull(Cache::get('roles::users'));
    }

    /** @test **/
    public function it_should_remove_permissions_roles_from_cache(): void
    {
        $this->assertNull(Cache::get('permissions::roles'));

        PermissionRole::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions::roles'));

        $this->forgetCachePermissionsRoles();

        $this->assertNull(Cache::get('permissions::roles'));
    }
}
