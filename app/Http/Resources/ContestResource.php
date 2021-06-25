<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'announced_at' => trim($this->announced_at->formatLocalized(config('settings.date_format'))),
            'finished_at' => trim($this->finished_at->formatLocalized(config('settings.date_format'))),
            'results_published_at' => trim($this->results_published_at->formatLocalized(config('settings.date_format'))),
            'created_at' => trim($this->created_at->formatLocalized(config('settings.date_format'))),
            'updated_at' => trim($this->updated_at->formatLocalized(config('settings.date_format'))),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
