<?php

namespace App\Jobs;

use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImportWorks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $db = DB::connection('urad');

        // Remove Works no longer present in source DB
        Work::whereNotIn('id', $db->table('lab_works')->pluck('id'))->delete();

        // Remove Media no longer present in source DB
        Media::whereNotNull('custom_properties->urad_id')
            ->whereNotIn('custom_properties->urad_id', $db->table('lab_media')->pluck('id'))->delete();

        $db->table('lab_works')
            ->lazyById()
            ->each(function ($sourceWork) use ($db) {
                $work = Work::unguarded(function() use ($sourceWork) {
                    return Work::updateOrCreate(
                        ['id' => $sourceWork->id],
                        (array) $sourceWork
                    );
                });

                $this->importMedia($work, $db);
            });
    }

    private function importMedia(Work $work, ConnectionInterface $db) {
        $existingUradIds = $work->getMedia('images')->map->getCustomProperty('urad_id');

        $db->table('lab_media')
            ->where('model_type', 'App\Models\Work')
            ->where('collection_name', 'work_pictures')
            ->where('model_id', $work->id) // Work ID from 'Urad' matches our Work ID
            ->whereNotIn('id', $existingUradIds)
            ->lazyById()
            ->each(function ($sourceMedium) use ($work) {
                $work
                    ->addMediaFromDisk("lab_sng/{$sourceMedium->id}/{$sourceMedium->file_name}", 'urad')
                    ->preservingOriginal()
                    ->withCustomProperties([
                        'urad_id' => $sourceMedium->id,
                    ])
                    ->toMediaCollection('images');
            });
    }
}
