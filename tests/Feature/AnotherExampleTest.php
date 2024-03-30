<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnotherExampleTest extends TestCase
{
    use RefreshDatabase;
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

    public function test_see3()
    {
        $response = $this->get('/dashboard');
        $response->assertDontSee('You\'re logged in!');
    }

    public function test_see4()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('dashboard');
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertSee('You\'re logged in!');

        $this->assertDatabaseCount('users', 1);
    }

    public function test_database_count()
    {
        $this->assertDatabaseCount('users', 0);
    }

    public function test_session()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->actingAs($user)->withSession(["status" => 'profile-updated'])->get('/profile');

        $response->assertSee('Saved');
    }

    public function test_dump()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        //$response->dump();
        //$response->dumpSession();
        //$response->dumpHeaders();
    }

    public function test_making_an_api_request()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get('/api/user');
        $response->assertOk();
    }
}
