<?php

namespace Tests\Feature\Http\Middleware;

use Illuminate\Http\Response;
use Tests\TestCase;

class CheckPermissionTest extends TestCase
{
    /** @test **/
    public function it_should_test(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(Response::HTTP_OK);
    }
}
