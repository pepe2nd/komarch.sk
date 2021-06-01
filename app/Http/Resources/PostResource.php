<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'perex' => $this->perex,
            'date' => trim($this->published_at->formatLocalized('%e. %B %Y')),
            'url' => $this->url,
            'cover_image' => new MediaResource($this->cover_image),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
