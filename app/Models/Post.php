<?php

namespace App\Models;

use App\Traits\Publishable;
use App\Traits\HasCoverImage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use ElasticScoutDriverPlus\QueryDsl;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        Searchable,
        QueryDsl,
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
        'published_at',
        'is_featured',
        'cover_image',
    ];
    protected $dates = ['published_at'];
    protected $casts = [
        'is_featured' => 'boolean',
    ];

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

}
