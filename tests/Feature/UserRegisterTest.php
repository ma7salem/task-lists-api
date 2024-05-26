<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_a_user_can_register(): void
    {
        $inputs   = [
            'name'  => 'mahmoud salem',
            'email' => 'example@test.com',
            'password'  => '123123123',
            'password_confirmation' => '123123123'
        ];
        $response = $this->postJson(route('user.register'), $inputs)
        ->assertCreated()
        ->json();

        $this->assertDatabaseHas('users', ['email' => $inputs['email']]);
    }

    public function test_user_can_not_register_with_taken_email(): void 
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $inputs   = [
            'name'  => 'mahmoud salem',
            'email' => $user->email,
            'password'  => '123123123',
            'password_confirmation' => '123123123'
        ];  
        $this->postJson(route('user.register'), $inputs)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
    }
}
