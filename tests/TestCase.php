<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected bool $seed = true;

    public User $user;

    public function authenticate(): self
    {
        $this->user = User::factory()->create();

        return $this->actingAs($this->user);
    }

    public function withRoles(array $roles = []): self
    {
        $this->user->syncRoles($roles);

        return $this;
    }
}
