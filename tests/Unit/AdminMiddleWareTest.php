<?php

namespace Tests\Feature;

use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminMiddlewareTest extends TestCase
{
    use HasFactory;
    /** @test */
    public function nonAdminsAreRedirected() // les personnes non admin ne peuvent pas accéder au back-office
    {
        $user = User::factory()->make();    // on crée un user avec factory 
        $this->actingAs($user);             // on se connecte en tant que ce user 
        $response = $this->get('/admin/index');
        $this->assertEquals(403, $response->getStatusCode());
    }

    /** @test */
    public function adminsAreNotRedirected() // les admins ne sont pas redirigés quand ils accèdent au back-office
    {
        $user = User::factory()->make(['role_id' => 2]); // je crée un admin
        $this->actingAs($user);                          // je me connecte
        $request = Request::create('/admin', 'GET');     // requête accès au back-office
        $middleware = new IsAdmin;                       // création du middleware isAdmin
        $response = $middleware->handle($request, function () {}); // test du middleware
        $this->assertEquals($response, null);            // je teste qu'il fonctionne
    }
}

