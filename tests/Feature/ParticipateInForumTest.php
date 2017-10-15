<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserMayParticipateInThreads()
    {
        $user = factory('App\User')->create();
        $this->be($user);

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    public function testUnauthenticatedUserMayNotParticipateInThreads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/1/replies', []);
    }
}
