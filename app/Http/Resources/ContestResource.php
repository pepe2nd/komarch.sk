<?php

namespace App\Http\Resources;

use Carbon\CarbonInterface;
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
            'next_proposal' => $this->whenLoaded('nextProposal', fn () => $this->nextProposal->date->isFuture() ? $this->nextProposal->date->format(config('settings.date_short_format')) : null),
            'next_proposal_diff' => $this->whenLoaded('nextProposal', fn () => $this->nextProposal->date->isFuture() ? $this->nextProposal->date->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) : null),
            'results_published_at' => optional($this->results_published_at)->format(config('settings.date_short_format')),
            'results_published_is_passed' => optional($this->results_published_at)->isPast(),
            'created_at' => optional($this->created_at)->format(config('settings.date_short_format')),
            'updated_at' => optional($this->updated_at)->format(config('settings.date_short_format')),
            'cover_image' => new MediaResource($this->cover_image),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
