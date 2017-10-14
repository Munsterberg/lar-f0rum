<?php

namespace Test\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testAThreadHasReplies()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);

    }

    public function testThreadHasCreator()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf('App\User', $thread->owner);
    }
}