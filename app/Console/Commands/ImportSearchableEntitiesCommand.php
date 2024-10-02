<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Work;
use App\Models\Contest;
use App\Models\Document;
use App\Models\Architect;
use App\Models\Page;
use Illuminate\Console\Command;

class ImportSearchableEntitiesCommand extends Command
{
    private const SEARCHABLE_ENTITIES = [
        Post::class,
        Architect::class,
        Work::class,
        Contest::class,
        Document::class,
        Page::class,
    ];

    protected $signature = 'komarch:search:import';
    protected $description = 'Import all searchable entities with Scout';

    public function handle(): int
    {
        foreach (self::SEARCHABLE_ENTITIES as $entity) {
            $this->call('scout:import', ['model' => $entity]);
        }

        return self::SUCCESS;
    }
}
