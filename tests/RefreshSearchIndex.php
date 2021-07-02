<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

trait RefreshSearchIndex
{
    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function refreshSearchIndex()
    {
        $migrationsDbTable =  DB::table(config('elastic.migrations.table'));

        if (!RefreshSearchIndexState::$migrations) {
            $this->artisan('elastic:migrate');
            $this->app[Kernel::class]->setArtisan(null);

            RefreshSearchIndexState::$migrations = $migrationsDbTable->get();
        }

        $this->beforeApplicationDestroyed(function () use ($migrationsDbTable) {
            $migrations = RefreshSearchIndexState::$migrations->map(fn ($a) => (array) $a)->toArray();
            $migrationsDbTable->upsert($migrations, ['migration']);

            $this->artisan('elastic:migrate:reset');
            $this->app[Kernel::class]->setArtisan(null);

            RefreshSearchIndexState::$migrations = null;
        });
    }
}
