<?php

namespace App\Http\Resources;

use App\Models\Number;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ArchitectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            Arr::only(
                $this->resource->attributesToArray(),
                ['id', 'first_name', 'last_name', 'works_count', 'awards_count', 'contests_count']
            ),
            [
                'number' => (Number::isRemoved($this->architect_number)) ? trans_choice('architects.removed', $this->architect_number.$this->gender) : $this->architect_number,
                'location_city' => $this->whenLoaded('address', fn () => $this->address->location_city),
                'full_name' => $this->full_name,
                'url' => $this->url,
            ],
        );
    }
}
