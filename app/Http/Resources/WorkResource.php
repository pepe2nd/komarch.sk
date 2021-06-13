<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
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
            'name' => $this->name,
            'url' => $this->url,
            'cover_image' => new MediaResource($this->cover_image),
            'created_at' => trim($this->created_at->formatLocalized('%e. %B %Y')),
            'filters' => $this->filters,
            'other_architects' => TagResource::collection($this->whenLoaded('other_architects')),

        ];
    }
}
