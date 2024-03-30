<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\ExampleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Mockery\MockInterface;
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

    public function test_making_an_api_request_create_post()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->postJson('/api/posts/create', [
            'title' => 'Post title',
            'content' => 'Post content'
        ]);

        $response->assertJson([
            'post' => true,
        ]);
    }

    public function test_view()
    {
        $view = $this->view('posts.create', ['errors' => null]);
        $view->assertSee('New blog post');
    }

    public function test_component()
    {
        $view = $this->blade(
            '<x-auth-session-status :status="$status" />',
            ['status' => 'Status 2']
        );
        $view->assertSee('Status 2');
    }

    public function test_mock_service()
    {
        $this->mock(ExampleService::class, function(MockInterface $mock) {
            $mock->shouldReceive('execute')->once()->andReturn('fake return');
        });
        $response = $this->get('/test');
        $response->assertSee('fake return');
    }
}
