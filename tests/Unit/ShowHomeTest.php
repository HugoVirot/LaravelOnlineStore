<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowHomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowHome()
    {
        $response = $this->get('/');

        $response->assertStatus(200); // 200 = code de succès HTTP
    }
}
