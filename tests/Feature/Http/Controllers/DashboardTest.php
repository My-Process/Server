<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticate();
    }

    /** @test **/
    public function it_should_block_user_access_as_he_does_not_have_the_necessary_role()
    {
        $response = $this->get('/dashboard')->assertForbidden();

        $this->assertEquals($response->getContent(), view('errors.403'));
    }

    /** @test **/
    public function it_should_render_the_dashboard_screen_via_web()
    {
        $this->withRoles(['administrator']);

        $response = $this->get('/dashboard')->assertOk();

        $this->assertEquals($response->getContent(), view('dashboard'));
    }
}
