<?php

namespace Tests\Feature\Http\Middleware;

use Tests\TestCase;

class CheckPermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
