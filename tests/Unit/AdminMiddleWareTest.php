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
    public function nonAdminsAreRedirected()
    {
        $user = User::factory()->make();
        $this->actingAs($user);
        $request = Request::create('/admin', 'GET');
        $middleware = new IsAdmin;
        $response = $middleware->handle($request, function () {});
        $this->assertEquals($response->getStatusCode(), 302);
    }


    /** @test */
    public function adminsAreNotRedirected()
    {
        $user = User::factory()->make(['role_id' => 2]);
        $this->actingAs($user);
        $request = Request::create('/admin', 'GET');
        $middleware = new IsAdmin;
        $response = $middleware->handle($request, function () {});
        $this->assertEquals($response, null);
    }
}

