<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnotherExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_see()
    {
        $response = $this->get('/');
        $response->assertSee('Latest posts');
        $response->assertDontSee('Latest news');
    }

    public function test_see2()
    {
        $response = $this->get('/register');
        $response->assertSee('Confirm Password');
    }
}
