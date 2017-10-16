<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserCanCreateNewThreads()
    {
        $user = create('App\User');
        $this->signIn($user);

        $thread = make('App\Thread');
        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function testAuthenticatedUserCannotCreateNewThreads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());
    }

    public function testGuestCannotSeeCreatePage()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function testThreadRequiresATitle()
    {
        $this->expectException('Illuminate\Database\QueryException');
        $this->signIn();

        $thread = make('App\Thread', ['title' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('title');
    }


    public function testThreadRequiresBody()
    {
        $this->expectException('Illuminate\Database\QueryException');
        $this->signIn();

        $thread = make('App\Thread', ['body' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('body');
    }

    public function testThreadRequiresValidChannel()
    {
        factory('App\Channel', 2)->create();
        $this->expectException('Illuminate\Database\QueryException');
        $this->signIn();

        $thread = make('App\Thread', ['channel_id' => null]);
        $thread2 = make('App\Thread', ['channel_id' => 9999]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('channel_id');
        $this->post('/threads', $thread2->toArray())
            ->assertSessionHasErrors('channel_id');
    }
}
