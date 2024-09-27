<?php

namespace App\Models;

use Spatie\Tags\Tag;
use Spatie\Tags\HasTags;
use App\Traits\Publishable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Traits\HasCoverImage;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Post extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        Searchable,
        HasSlug,
        HasTags,
        Publishable,
        HasTranslations,
        CrudTrait,
        InteractsWithMedia,
        HasCoverImage;

    public $translatable = [
        'title',
        'perex',
        'text',
    ];

    public $with = ['tags'];

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'perex',
        'text',
        'wp_post_name',
        'published_at',
        'is_featured',
        'cover_image',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public $asYouType = true;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getWordpressFullUrlAttribute(): string
    {
        return "/{$this->wp_post_name}";
    }

    public function getUrlAttribute(): string
    {
        return action('\App\Http\Controllers\PostsController@show', $this);
    }

    public function getExcerptAttribute(): ?string
    {
        if ($this->perex) {
            return $this->perex;
        }
        return Str::words(strip_tags($post->text), 70);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover')
            ->acceptsMimeTypes(['image/jpeg', 'image/gif', 'image/png'])
            ->withResponsiveImages();
    }

    public function shouldBeSearchable(): bool
    {
        return $this->is_published;
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'perex' => $this->perex
        ];
    }
}
