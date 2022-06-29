<?php

namespace Tests\Feature\Traits\Models;

use Tests\TestCase;

class HasRolesTest extends TestCase
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
