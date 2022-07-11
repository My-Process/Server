<?php

namespace Tests\Feature\Traits\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tests\TestCase;

class HasRolesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        $this->user = User::factory()->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    /** @test */
    public function it_should_check_if_the_roles_are_cached_correctly(): void
    {
        $roles      = Role::all();
        $rolesCache = Role::getAllFromCache();

        $this->assertEquals($roles, $rolesCache);
        $this->assertCount($roles->count(), $rolesCache);

        $random = Role::inRandomOrder()->first();

        $this->assertEquals($random, Role::getRole($random->id));
        $this->assertEquals($random, Role::getRole($random->slug));
        $this->assertEquals($random, Role::getRole($random->name));
    }

    /** @test */
    public function it_should_return_user_roles_correctly_and_in_this_case_empty(): void
    {
        $role = Role::getAllFromCache()->shuffle()->first();

        $userRoles = $this->user->getRoles();

        $this->assertCount(0, $userRoles);
        $this->assertEquals(false, $this->user->hasRoleTo($role->id));
        $this->assertEquals(false, $this->user->hasRoleTo($role->slug));
        $this->assertEquals(false, $this->user->hasRoleTo($role->name));

        $this->assertDatabaseMissing('role_user', ['user_id' => $this->user->id]);

        $roles = collect()->range(1, 30);

        $roles->each(fn () => $this->assertEquals(false, $this->user->hasRoleTo(Str::random(8))));
    }

    /** @test */
    public function it_should_add_a_role_for_the_user_successfully(): void
    {
        $role = Role::getAllFromCache()->shuffle()->first();

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $userRoles = $this->user->getRoles();

        $this->assertCount(1, $userRoles);
        $this->assertEquals(true, $this->user->hasRoleTo($role->id));
        $this->assertEquals(true, $this->user->hasRoleTo($role->slug));
        $this->assertEquals(true, $this->user->hasRoleTo($role->name));

        $this->assertDatabaseHas('role_user', [
            'user_id' => $this->user->id,
            'role_id' => $role->id,
        ]);
    }

    /** @test */
    public function it_should_remove_user_roles_as_requested(): void
    {
        $role = Role::getAllFromCache()->shuffle()->first();

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $this->assertEquals(true, $this->user->hasRoleTo($role->id));
        $this->assertEquals(true, $this->user->hasRoleTo($role->slug));
        $this->assertEquals(true, $this->user->hasRoleTo($role->name));

        $this->assertDatabaseHas('role_user', [
            'user_id' => $this->user->id,
            'role_id' => $role->id,
        ]);

        $this->user->revokeRoleTo($role->id);
        $this->user->revokeRoleTo($role->slug);
        $this->user->revokeRoleTo($role->name);

        $userRoles = $this->user->getRoles();

        $this->assertCount(0, $userRoles);
        $this->assertEquals(false, $this->user->hasRoleTo($role->id));
        $this->assertEquals(false, $this->user->hasRoleTo($role->slug));
        $this->assertEquals(false, $this->user->hasRoleTo($role->name));

        $this->assertDatabaseMissing('role_user', [
            'user_id' => $this->user->id,
            'role_id' => $role->id,
        ]);
    }

    /** @test */
    public function it_should_sync_roles_for_the_user(): void
    {
        $roles = Role::getAllFromCache();

        $this->user->syncRoles($roles->pluck('id')->toArray());
        $this->user->syncRoles($roles->pluck('slug')->toArray());
        $this->user->syncRoles($roles->pluck('name')->toArray());

        $userRoles = $this->user->getRoles();

        $this->assertEquals($userRoles, $roles->unique());
        $this->assertCount($roles->count(), $userRoles);

        $roles->each(function (Role $role) {
            $this->assertEquals(true, $this->user->hasRoleTo($role->id));
            $this->assertEquals(true, $this->user->hasRoleTo($role->slug));
            $this->assertEquals(true, $this->user->hasRoleTo($role->name));

            $this->assertDatabaseHas('role_user', [
                'user_id' => $this->user->id,
                'role_id' => $role->id,
            ]);
        });

        $this->user->syncRoles([]);

        $this->assertDatabaseMissing('role_user', ['user_id' => $this->user->id]);
    }

    /** @test */
    public function it_should_validate_if_the_user_has_at_least_one_role_assigned(): void
    {
        $roles = Role::getAllFromCache();

        $role = $roles->shuffle()->first();

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $this->assertEquals(true, $this->user->hasAnyRole($roles->pluck('id')->toArray()));
        $this->assertEquals(true, $this->user->hasAnyRole($roles->pluck('slug')->toArray()));
        $this->assertEquals(true, $this->user->hasAnyRole($roles->pluck('name')->toArray()));

        $this->user->revokeRoleTo($role->id);
        $this->user->revokeRoleTo($role->slug);
        $this->user->revokeRoleTo($role->name);

        $this->assertEquals(false, $this->user->hasAnyRole($roles->pluck('id')->toArray()));
        $this->assertEquals(false, $this->user->hasAnyRole($roles->pluck('slug')->toArray()));
        $this->assertEquals(false, $this->user->hasAnyRole($roles->pluck('name')->toArray()));
    }

    /** @test */
    public function it_should_validate_if_the_user_has_all_the_roles_assigned(): void
    {
        $roles = Role::getAllFromCache();

        $role = $roles->shuffle()->first();

        $this->user->syncRoles($roles->pluck('id')->toArray());
        $this->user->syncRoles($roles->pluck('slug')->toArray());
        $this->user->syncRoles($roles->pluck('name')->toArray());

        $this->assertEquals(true, $this->user->hasAllRoles($roles->pluck('id')->toArray()));
        $this->assertEquals(true, $this->user->hasAllRoles($roles->pluck('slug')->toArray()));
        $this->assertEquals(true, $this->user->hasAllRoles($roles->pluck('name')->toArray()));

        $this->user->syncRoles([]);

        $this->assertEquals(false, $this->user->hasAllRoles($roles->pluck('id')->toArray()));
        $this->assertEquals(false, $this->user->hasAllRoles($roles->pluck('slug')->toArray()));
        $this->assertEquals(false, $this->user->hasAllRoles($roles->pluck('name')->toArray()));

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $this->assertEquals(false, $this->user->hasAllRoles($roles->pluck('id')->toArray()));
        $this->assertEquals(false, $this->user->hasAllRoles($roles->pluck('slug')->toArray()));
        $this->assertEquals(false, $this->user->hasAllRoles($roles->pluck('name')->toArray()));
    }

    /*
    |--------------------------------------------------------------------------
    | Permission Via Roles
    |--------------------------------------------------------------------------
    */

    /** @test */
    public function it_should_return_all_user_permissions_through_roles(): void
    {
        $roles = Role::getAllFromCache();

        $role = $roles->shuffle()->first();

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $userPermissions = $this->user->getPermissions();

        $this->assertEquals($role->getPermissions(), $userPermissions);
        $this->assertCount($role->getPermissions()->count(), $userPermissions);

        $this->user->syncRoles($roles->pluck('id')->toArray());
        $this->user->syncRoles($roles->pluck('slug')->toArray());
        $this->user->syncRoles($roles->pluck('name')->toArray());

        $userPermissions = $this->user->getPermissions();

        $this->assertEquals(true, $userPermissions->count() >= $role->count());
    }

    /** @test */
    public function it_should_check_if_the_user_has_a_permission_from_the_roles(): void
    {
        $role = Role::getAllFromCache()->shuffle()->first();

        $permissions = $role->getPermissions();

        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasPermissionTo($permission->id)));
        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasPermissionTo($permission->slug)));

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $permissions->each(fn ($permission) => $this->assertEquals(true, $this->user->hasPermissionTo($permission->id)));
        $permissions->each(fn ($permission) => $this->assertEquals(true, $this->user->hasPermissionTo($permission->slug)));
    }

    /** @test */
    public function it_should_check_if_the_user_has_any_of_the_permissions_from_the_roles(): void
    {
        $role = Role::getAllFromCache()->shuffle()->first();

        $permissions = $role->getPermissions();

        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasAnyPermission([$permission->id, Str::random(8)])));
        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasAnyPermission([$permission->slug, Str::random(8)])));

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $permissions->each(fn ($permission) => $this->assertEquals(true, $this->user->hasAnyPermission([$permission->id, Str::random(8)])));
        $permissions->each(fn ($permission) => $this->assertEquals(true, $this->user->hasAnyPermission([$permission->slug, Str::random(8)])));
    }

    /** @test */
    public function it_should_check_if_the_user_has_all_the_permissions_from_the_roles(): void
    {
        $role = Role::getAllFromCache()->shuffle()->first();

        $permissions  = $role->getPermissions();
        $permissions2 = $permissions->shuffle();

        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasAllPermissions([$permission->id, $permissions2->random()->id])));
        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasAllPermissions([$permission->slug, $permissions2->random()->slug])));

        $this->user->assignRoleTo($role->id);
        $this->user->assignRoleTo($role->slug);
        $this->user->assignRoleTo($role->name);

        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasAllPermissions([$permission->id, Str::random(8)])));
        $permissions->each(fn ($permission) => $this->assertEquals(false, $this->user->hasAllPermissions([$permission->slug, Str::random(8)])));

        $permissions->each(fn ($permission) => $this->assertEquals(true, $this->user->hasAllPermissions([$permission->id, $permissions2->random()->id])));
        $permissions->each(fn ($permission) => $this->assertEquals(true, $this->user->hasAllPermissions([$permission->slug, $permissions2->random()->slug])));
    }
}
