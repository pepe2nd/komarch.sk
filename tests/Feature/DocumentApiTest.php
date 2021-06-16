<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentApiTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/api/documents');
        $response->assertStatus(200);
    }

    public function testFilters()
    {
        $response = $this->get('/api/documents-filters');
        $response->assertStatus(200);
    }
}
