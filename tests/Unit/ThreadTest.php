<?php

namespace Test\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function testAThreadHasReplies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);

    }

    public function testThreadHasCreator()
    {
        $this->assertInstanceOf('App\User', $this->thread->owner);
    }

    public function testThreadCanAddReply()
    {
        $this->thread->addReply([
            'body' => 'crazy',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}