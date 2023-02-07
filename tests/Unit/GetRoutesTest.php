<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetRoutesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     use RefreshDatabase;

    public function testGetRoutes()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/home');
        $response->assertStatus(200);
        
        $response = $this->get('articles');
        $response->assertStatus(200);
                
        $response = $this->get('gammes');
        $response->assertStatus(200);
                
        $response = $this->get('campagnes');
        $response->assertStatus(200);

        $response = $this->get('cart');
        $response->assertStatus(200);

        $response = $this->get('apropos');
        $response->assertStatus(200);
        
        //$response = $this->get('favoris');
        //$response->assertStatus(200);
    }
}
