<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CheckRoleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticate();
    }

    /** @test **/
    public function it_should_return_unauthorized_access_via_api(): void
    {
        $role = Role::factory()->create();

        Route::get('test-role', fn () => 'Success')->middleware('roles:'.$role->slug);

        $response = $this->getJson('/test-role')->assertForbidden();

        $response->assertJson(['message' => trans('auth.blocked'), 'data' => []]);

        Route::get('test-role', fn () => 'Success')->middleware('roles:');

        $response = $this->getJson('/test-role')->assertForbidden();

        $response->assertJson(['message' => trans('auth.blocked'), 'data' => []]);
    }

    /** @test **/
    public function it_should_return_unauthorized_access_via_web(): void
    {
        $role = Role::factory()->create();

        Route::get('test-role', fn () => 'Success')->middleware('roles:'.$role->slug);

        $response = $this->get('/test-role')->assertForbidden();

        $this->assertEquals($response->getContent(), view('errors.403'));

        Route::get('test-role', fn () => 'Success')->middleware('roles:');

        $response = $this->get('/test-role')->assertForbidden();

        $this->assertEquals($response->getContent(), view('errors.403'));
    }

    /** @test **/
    public function it_should_authorize_user_request(): void
    {
        $role = Role::factory()->create();

        $this->withRoles([$role->slug]);

        Route::get('test-role', fn () => 'Success')->middleware('roles:'.$role->slug);

        $response = $this->get('/test-role')->assertOk();

        $this->assertEquals($response->getContent(), 'Success');
    }
}
