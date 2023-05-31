<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\Feature\Concerns\CreatesUsers;
use Tests\Feature\Concerns\SendsRequests;
use Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use CreatesUsers, SendsRequests;

    /**
     * The authenticated user.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Simulate the request from the user's perspective.
     *
     * @param  \App\Models\User|null  $user
     * @return static
     */
    protected function signIn(User $user = null): static
    {
        $this->user = $user ?? $this->newUser();

        $this->actingAs($this->user);

        Sanctum::actingAs($this->user);

        return $this;
    }
}
