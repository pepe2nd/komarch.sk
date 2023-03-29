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
        return $this->belongsToMany(Architect::class)->wherePivot('type','a');
    }

    public function collaborators()
    {
        return $this->belongsToMany(Architect::class)->wherePivot('type','c');
    }

    public function other_architects()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'contestresult_author');
    }

    public function other_collaborators()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'contestresult_collaborator');
    }

}
