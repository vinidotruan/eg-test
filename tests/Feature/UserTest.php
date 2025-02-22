<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_login(): void
    {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password12345',
            'name' => 'test'
        ];
        $this->postJson(route('api.login'), $data)
            ->assertSuccessful();
    }

    public function test_user_check_anomalies(): void
    {
        $this->actingAs(User::first());
        $this->postJson(route('check'), [])->assertSuccessful();
    }
}
