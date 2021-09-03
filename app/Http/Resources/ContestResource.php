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
            'url' => $this->url,
            'state' => $this->state,
            'announced_at' => optional($this->announced_at)->format(config('settings.date_short_format')),
            'finished_at' => optional($this->finished_at)->format(config('settings.date_short_format')),
            'finished_at_diff' => optional($this->finished_at)->diffForHumans(),
            'results_published_at' => optional($this->results_published_at)->format(config('settings.date_short_format')),
            'created_at' => optional($this->created_at)->format(config('settings.date_short_format')),
            'updated_at' => optional($this->updated_at)->format(config('settings.date_short_format')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
