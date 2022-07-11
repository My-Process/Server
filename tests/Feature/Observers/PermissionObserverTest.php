<?php

namespace Tests\Feature\Observers;

use App\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PermissionObserverTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /** @test **/
    public function it_should_should_clear_permissions_cache_when_trigger_create_event(): void
    {
        $this->assertNull(Cache::get('permissions'));

        Permission::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions'));

        Permission::factory()->create();

        $this->assertNull(Cache::get('permissions'));
    }

    /** @test **/
    public function it_should_should_clear_permissions_cache_when_trigger_update_event(): void
    {
        $this->assertNull(Cache::get('permissions'));

        Permission::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions'));

        $permission = Permission::inRandomOrder()->first();

        $permission->fill(['name' => $this->faker->word()])->save();

        $this->assertNull(Cache::get('permissions'));
    }

    /** @test **/
    public function it_should_should_clear_permissions_cache_when_trigger_delete_event(): void
    {
        $this->assertNull(Cache::get('permissions'));

        Permission::getAllFromCache();

        $this->assertNotNull(Cache::get('permissions'));

        $permission = Permission::inRandomOrder()->first();

        $permission->delete();

        $this->assertNull(Cache::get('permissions'));
    }
}
