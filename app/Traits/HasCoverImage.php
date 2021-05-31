<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasCoverImage
{

    public function getCoverImageAttribute()
    {
        return $this->getFirstMedia('cover');
    }

    public function setCoverImageAttribute($uploaded_file)
    {
        $this->clearMediaCollection('cover');
        if (isSet($uploaded_file)) {
            $this
                ->addMedia($uploaded_file)
                ->usingFileName($uploaded_file->hashName())
                ->toMediaCollection('cover');
        }
    }
}
