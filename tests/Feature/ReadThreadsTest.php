<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function testUserSeesAllThreads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }

    public function testUserSeeSingleThread()
    {
        $response = $this->get($this->thread->path());
        $response->assertSee($this->thread->title);
    }

    public function testUserCanReadRepliesAssociatedWithThread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $response = $this->get($this->thread->path());
        $response->assertSee($reply->body);
    }
}
