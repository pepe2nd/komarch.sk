<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkApiTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/api/works');
        $response->assertStatus(200);
    }

    public function testFilters()
    {
        $response = $this->get('/api/works-filters');
        $response->assertStatus(200);
    }
}
