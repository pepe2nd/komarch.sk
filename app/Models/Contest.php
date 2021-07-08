<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Contest extends Model implements HasMedia
{
    use HasTags, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('contest_pictures')
            ->withResponsiveImages();

        $this
            ->addMediaCollection('contest_attachments');
    }
}
