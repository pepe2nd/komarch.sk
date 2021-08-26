<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class AddMediaFromUrad implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Model $entity;
    private object $sourceMedium;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $entity, object $sourceMedium)
    {
        $this->entity = $entity->withoutRelations();
        $this->sourceMedium = $sourceMedium;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->entity
            ->addMediaFromDisk("lab_sng/{$this->sourceMedium->id}/{$this->sourceMedium->file_name}", 'urad')
            ->preservingOriginal()
            ->withCustomProperties([
                'urad_id' => $this->sourceMedium->id,
            ])
            ->toMediaCollection($this->sourceMedium->collection_name);
    }
}
