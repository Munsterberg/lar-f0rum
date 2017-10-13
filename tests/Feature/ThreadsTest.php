<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function testUserReceivesThreads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
}
