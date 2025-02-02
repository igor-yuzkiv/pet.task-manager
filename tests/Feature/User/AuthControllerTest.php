<?php

namespace Tests\Feature\User;

use App\Domains\User\Models\User;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testLoginFailedDueToValidationErrors()
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


    public function testLoginFailedDueToUserNotExists()
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

    public function testLoginSuccess()
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

    public function testFetchCurrentUserSuccess()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('api/auth/me');

        $response->assertJson([
            'data' => [
                'id'    => (string)$user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
        ], true);
    }
}
