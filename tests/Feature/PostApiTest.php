<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function testFilters()
    {
        $response = $this->get('/api/posts-filters');
        $response->assertStatus(200);
    }

    public function testRelated()
    {
        $post = \App\Models\Post::factory()->create();
        $response = $this->get('/api/post/' . $post->id . '/related');
        $response->assertStatus(200);
    }
}
