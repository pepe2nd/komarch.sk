<?php

namespace Tests;

use App\Models\Page;
use App\Models\Post;
use App\Models\Work;
use App\Models\Contest;
use App\Models\Document;
use App\Models\Architect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait RefreshSearchIndex
{

    private const SEARCHABLE_ENTITIES = [
        Post::class,
        Architect::class,
        Work::class,
        Contest::class,
        Document::class,
        Page::class,
    ];

    /**
     * Refresh the search index before each test.
     *
     * @return void
     */
    public function refreshSearchIndex()
    {
        $this->removeIndexFiles();

        $this->beforeApplicationDestroyed(function () {
            $this->removeIndexFiles();
        });
    }

    private function removeIndexFiles()
    {
        $tntSearchIndexPath = config('scout.tntsearch.storage');

        if (File::exists($tntSearchIndexPath)) {
            $indexFiles = File::files($tntSearchIndexPath);

            foreach ($indexFiles as $file) {
                if ($file->isFile() && $file->getExtension() === 'index' && Str::startsWith($file->getFilename(), config('scout.prefix'))) {
                    File::delete($file);
                }
            }
        }
    }
}
