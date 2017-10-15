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
        $this->post('/threads', $thread->toArray());

        $response = $this->get($thread->path());
        $response->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function testAuthenticatedUserCannotCreateNewThreads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());
    }
}
