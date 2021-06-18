<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'name' => $this->name,
            'size' => $this->size,
            'mime_type' => $this->mime_type,
            'url' => $this->getFullUrl(),
            $this->mergeWhen($this->hasResponsiveImages(), function () {
                $responsiveImage = $this->responsiveImages()->files->first();
                return [
                    'srcset' => $this->getSrcset(),
                    'width' => $responsiveImage->width(),
                    'height' => $responsiveImage->height(),
                ];
            }),
        ];
    }
}
