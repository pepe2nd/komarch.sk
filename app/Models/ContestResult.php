<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Contestresult extends Model implements HasMedia
{
    use InteractsWithMedia, HasTags;

    protected $table = 'contestresults';

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('contestresult_pictures')
            ->withResponsiveImages();
    }

    public function architects()
    {
        return $this->belongsToMany(Architect::class)->withPivot('type');
    }

    public function other_architects()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'contestresult_author');
    }

}
