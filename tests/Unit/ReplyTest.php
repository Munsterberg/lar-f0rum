<?php

namespace Tests\Unit;

use Illuminate\Foundation\Auth\RegistersUsers;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    public function testReplyHasOwner()
    {
        $reply = create('App\Reply');
        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
