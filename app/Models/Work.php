<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Work extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTags;

    public $with = ['other_architects', 'awards'];

    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }

    public function other_architects()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'other_architect');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->withResponsiveImages();
    }

    public function getUrlAttribute(): string
    {
        return url('/dielo/' . $this->id); // @TODO (slug?)
    }

    public function getCoverImageAttribute()
    {
        return $this->getFirstMedia('images');
    }

}
