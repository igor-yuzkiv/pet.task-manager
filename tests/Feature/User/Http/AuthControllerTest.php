<?php

namespace Tests\Feature\User\Http;

use App\Domains\User\Models\User;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_login_failed_due_to_validation_errors()
    {
        $this->post(
            'api/auth/login',
            [
                'email'    => 'wrong-email',
                'password' => 'wrong-password',
            ]
        )
            ->assertInvalid(['email']);
    }

    public function test_login_failed_due_to_user_not_exists()
    {
        $this->post(
            'api/auth/login',
            [
                'email'    => 'wrong@user.com',
                'password' => 'password',
            ]
        )
            ->assertStatus(401);
    }

    public function test_login_success()
    {
        $user = User::factory()->create();

        $this->post(
            'api/auth/login',
            [
                'email'    => $user->email,
                'password' => 'password',
            ]
        )
            ->assertStatus(200);
    }

    public function test_fetch_current_user_success()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('api/auth/me');

        $response->assertJson([
            'data' => [
                'id'    => (string) $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
        ], true);
    }
}
