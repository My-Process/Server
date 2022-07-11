<?php

namespace Tests\Feature\Observers;

use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RoleObserverTest extends TestCase
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
        $this->assertNull(Cache::get('roles'));

        Role::getAllFromCache();

        $this->assertNotNull(Cache::get('roles'));

        Role::factory()->create();

        $this->assertNull(Cache::get('roles'));
    }

    /** @test **/
    public function it_should_should_clear_roles_cache_when_trigger_update_event(): void
    {
        $this->assertNull(Cache::get('roles'));

        Role::getAllFromCache();

        $this->assertNotNull(Cache::get('roles'));

        $role = Role::inRandomOrder()->first();

        $role->fill(['description' => $this->faker->sentence(5)])->save();

        $this->assertNull(Cache::get('roles'));
    }

    /** @test **/
    public function it_should_should_clear_roles_cache_when_trigger_delete_event(): void
    {
        $this->assertNull(Cache::get('roles'));

        Role::getAllFromCache();

        $this->assertNotNull(Cache::get('roles'));

        $role = Role::inRandomOrder()->first();

        $role->delete();

        $this->assertNull(Cache::get('roles'));
    }
}
