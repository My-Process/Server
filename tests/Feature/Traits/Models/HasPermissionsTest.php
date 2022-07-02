<?php

namespace Tests\Feature\Traits\Models;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tests\TestCase;

class HasPermissionsTest extends TestCase
{
    protected Role $role;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        $this->role = Role::factory()->create();
    }

    /** @test */
    public function it_should_check_if_the_permissions_are_cached_correctly(): void
    {
        $permissions      = Permission::all();
        $permissionsCache = Permission::getAllFromCache();

        $this->assertEquals($permissions, $permissionsCache);
        $this->assertCount($permissions->count(), $permissionsCache);

        $random = Permission::inRandomOrder()->first();

        $this->assertEquals($random, Permission::getPermission($random->id));
        $this->assertEquals($random, Permission::getPermission($random->slug));
    }

    /** @test */
    public function it_should_return_role_permissions_correctly_and_in_this_case_empty(): void
    {
        $permission = Permission::getAllFromCache()->shuffle()->first();

        $rolePermissions = $this->role->getPermissions();

        $this->assertCount(0, $rolePermissions);
        $this->assertEquals(false, $this->role->hasPermissionTo($permission->id));
        $this->assertEquals(false, $this->role->hasPermissionTo($permission->slug));

        $this->assertDatabaseMissing('permission_role', ['role_id' => $this->role->id]);

        $permissions = collect()->range(1, 30);

        $permissions->each(fn () => $this->assertEquals(false, $this->role->hasPermissionTo(Str::random(8))));
    }

    /** @test */
    public function it_should_add_a_permission_for_the_role_successfully(): void
    {
        $permission = Permission::getAllFromCache()->shuffle()->first();

        $this->role->assignPermissionTo($permission->id);
        $this->role->assignPermissionTo($permission->slug);

        $rolePermissions = $this->role->getPermissions();

        $this->assertCount(1, $rolePermissions);
        $this->assertEquals(true, $this->role->hasPermissionTo($permission->id));
        $this->assertEquals(true, $this->role->hasPermissionTo($permission->slug));

        $this->assertDatabaseHas('permission_role', [
            'role_id'       => $this->role->id,
            'permission_id' => $permission->id,
        ]);
    }

    /** @test */
    public function it_should_remove_role_permissions_as_requested(): void
    {
        $permission = Permission::getAllFromCache()->shuffle()->first();

        $this->role->assignPermissionTo($permission->id);
        $this->role->assignPermissionTo($permission->slug);

        $this->assertEquals(true, $this->role->hasPermissionTo($permission->id));
        $this->assertEquals(true, $this->role->hasPermissionTo($permission->slug));

        $this->assertDatabaseHas('permission_role', [
            'role_id'       => $this->role->id,
            'permission_id' => $permission->id,
        ]);

        $this->role->revokePermissionTo($permission->id);
        $this->role->revokePermissionTo($permission->slug);

        $rolePermissions = $this->role->getPermissions();

        $this->assertCount(0, $rolePermissions);
        $this->assertEquals(false, $this->role->hasPermissionTo($permission->id));
        $this->assertEquals(false, $this->role->hasPermissionTo($permission->slug));

        $this->assertDatabaseMissing('permission_role', [
            'role_id'       => $this->role->id,
            'permission_id' => $permission->id,
        ]);
    }

    /** @test */
    public function it_should_sync_permissions_for_the_role(): void
    {
        $permissions = Permission::getAllFromCache();

        $this->role->syncPermissions($permissions->pluck('id')->toArray());
        $this->role->syncPermissions($permissions->pluck('slug')->toArray());

        $rolePermissions = $this->role->getPermissions();

        $this->assertEquals($rolePermissions, $permissions->unique());
        $this->assertCount($permissions->count(), $rolePermissions);

        $permissions->each(function (Permission $permission) {
            $this->assertEquals(true, $this->role->hasPermissionTo($permission->id));
            $this->assertEquals(true, $this->role->hasPermissionTo($permission->slug));

            $this->assertDatabaseHas('permission_role', [
                'role_id'       => $this->role->id,
                'permission_id' => $permission->id,
            ]);
        });

        $this->role->syncPermissions([]);

        $this->assertDatabaseMissing('permission_role', ['role_id' => $this->role->id]);
    }

    /** @test */
    public function it_should_validate_if_the_role_has_at_least_one_permission_assigned(): void
    {
        $permissions = Permission::getAllFromCache();

        $permission = $permissions->shuffle()->first();

        $this->role->assignPermissionTo($permission->id);
        $this->role->assignPermissionTo($permission->slug);

        $this->assertEquals(true, $this->role->hasAnyPermission($permissions->pluck('id')->toArray()));
        $this->assertEquals(true, $this->role->hasAnyPermission($permissions->pluck('slug')->toArray()));

        $this->role->revokePermissionTo($permission->id);
        $this->role->revokePermissionTo($permission->slug);

        $this->assertEquals(false, $this->role->hasAnyPermission($permissions->pluck('id')->toArray()));
        $this->assertEquals(false, $this->role->hasAnyPermission($permissions->pluck('slug')->toArray()));
    }

    /** @test */
    public function it_should_validate_if_the_role_has_all_the_permissions_assigned(): void
    {
        $permissions = Permission::getAllFromCache();

        $permission = $permissions->shuffle()->first();

        $this->role->syncPermissions($permissions->pluck('id')->toArray());
        $this->role->syncPermissions($permissions->pluck('slug')->toArray());

        $this->assertEquals(true, $this->role->hasAllPermissions($permissions->pluck('id')->toArray()));
        $this->assertEquals(true, $this->role->hasAllPermissions($permissions->pluck('slug')->toArray()));

        $this->role->syncPermissions([]);

        $this->assertEquals(false, $this->role->hasAllPermissions($permissions->pluck('id')->toArray()));
        $this->assertEquals(false, $this->role->hasAllPermissions($permissions->pluck('slug')->toArray()));

        $this->role->assignPermissionTo($permission->id);
        $this->role->assignPermissionTo($permission->slug);

        $this->assertEquals(false, $this->role->hasAllPermissions($permissions->pluck('id')->toArray()));
        $this->assertEquals(false, $this->role->hasAllPermissions($permissions->pluck('slug')->toArray()));
    }
}
