<?php

namespace Tests\Feature;

use App\Jobs\ImportFromUrad;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ImportApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Bus::fake();
        Config::set('auth.jobs_api_key', 'test-api-key');
    }

    public function testDispatchesImportJob()
    {
        $this->post('/api/jobs/import-from-urad', ['apiKey' => 'test-api-key']);
        Bus::assertDispatched(ImportFromUrad::class);
    }

    public function testRejectsUnauthorizedRequests()
    {
        $response = $this->post('/api/jobs/import-from-urad');
        $response->assertStatus(401);
    }
}
