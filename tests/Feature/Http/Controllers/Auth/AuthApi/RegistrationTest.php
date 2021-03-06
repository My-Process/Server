<?php

namespace Tests\Feature\Http\Controllers\Auth\AuthApi;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /** @test **/
    public function test_new_users_can_register()
    {
        $response = $this->post('/api/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();

        $response->assertNoContent();
    }
}
