<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

        
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory(User::class)->make();
        
        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }
}
