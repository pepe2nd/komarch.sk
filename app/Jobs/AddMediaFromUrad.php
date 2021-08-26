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
    private int $urad_id;
    private string $urad_path;
    private string $collection_name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $entity, int $urad_id, string $urad_path, string $collection_name)
    {
        $this->entity = $entity->withoutRelations();
        $this->urad_id = $urad_id;
        $this->urad_path = $urad_path;
        $this->collection_name = $collection_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->entity
            ->addMediaFromDisk($this->urad_path, 'urad')
            ->preservingOriginal()
            ->withCustomProperties([
                'urad_id' => $this->urad_id,
            ])
            ->toMediaCollection($this->collection_name);
    }
}
