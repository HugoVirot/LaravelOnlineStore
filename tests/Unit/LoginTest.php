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
        $response = $this->get('/login'); // je demande l'adresse /login (formulaire de connexion)

        $response->assertSuccessful(); // je m'attends à ce que la page soit bien affichée (code HTTP 200)
        $response->assertViewIs('auth.login');  // je m'attends à ce que la vue blade soit auth.login
    }

        
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory(User::class)->make();
        
        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }
}
