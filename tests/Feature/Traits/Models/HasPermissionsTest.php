<?php

namespace Tests\Feature\Traits\Models;

use Tests\TestCase;

class HasPermissionsTest extends TestCase
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
