<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_login(): void
    {
        $user       = User::factory()->create();
        $response   = $this->postJson(route('user.login'), ['email' => $user->email, 'password' => 'password'])
                      ->assertOk()
                      ->json();
        
        $this->assertArrayHasKey('token', $response);
    }

    public function test_if_user_try_to_send_not_valid_email_to_will_get_an_error() : void 
    {
        $this->postJson(route('user.login'), ['email' => 'examble@gmail.com', 'password' => 'password'])
        ->assertUnauthorized();
    }

    public function test_if_user_try_to_send_not_valid_password_to_will_get_an_error() : void 
    {
        $user       = User::factory()->create();
        $this->postJson(route('user.login'), ['email' => $user->email, 'password' => 'password123'])
        ->assertUnauthorized();
    }
}
