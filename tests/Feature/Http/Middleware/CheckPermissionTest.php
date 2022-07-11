<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CheckPermissionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticate();
    }

    /** @test **/
    public function it_should_return_unauthorized_access_via_api(): void
    {
        $permission = Permission::factory()->create();

        Route::get('test-permission', fn () => 'Success')->middleware('permissions:'.$permission->slug);

        $response = $this->getJson('/test-permission')->assertForbidden();

        $response->assertJson(['message' => trans('auth.blocked'), 'data' => []]);

        Route::get('test-permission', fn () => 'Success')->middleware('permissions:');

        $response = $this->getJson('/test-permission')->assertForbidden();

        $response->assertJson(['message' => trans('auth.blocked'), 'data' => []]);
    }

    /** @test **/
    public function it_should_return_unauthorized_access_via_web(): void
    {
        $permission = Permission::factory()->create();

        Route::get('test-permission', fn () => 'Success')->middleware('permissions:'.$permission->slug);

        $response = $this->get('/test-permission')->assertForbidden();

        $this->assertEquals($response->getContent(), view('errors.403'));

        Route::get('test-permission', fn () => 'Success')->middleware('permissions:');

        $response = $this->get('/test-permission')->assertForbidden();

        $this->assertEquals($response->getContent(), view('errors.403'));
    }

    /** @test **/
    public function it_should_authorize_user_request(): void
    {
        $role = Role::factory()->create();

        $this->withRoles([$role->slug]);

        $permission = Permission::factory()->create();

        $role->assignPermissionTo($permission->id);

        Route::get('test-permission', fn () => 'Success')->middleware('permissions:'.$permission->slug);

        $response = $this->get('/test-permission')->assertOk();

        $this->assertEquals($response->getContent(), 'Success');
    }
}
