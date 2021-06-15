<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;

class Work extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, InteractsWithMedia, HasTags;

    public $with = ['other_architects', 'awards'];

    public static $filterable = ['other_architects', 'awards'];

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
        return route('works.detail', [$this->id, $this->slug]);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }

    public function getCoverImageAttribute()
    {
        return $this->getFirstMedia('images');
    }

    public function getFiltersAttribute()
    {
        $tags = [
            $this->awards->pluck('name')->all(),
            $this->location_city,
            (string)$this->year,
            // @TODO functions
        ];

        return Arr::flatten(Arr::where($tags, fn ($tag) => !empty($tag)));
    }

    public function getYearAttribute()
    {
        // @TODO -> years span or just single year? date_design_start or date_construction_start ?
        return $this->date_design_start;
    }


}
