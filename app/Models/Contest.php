<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Contest extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasTags;

    protected $dates = [
        'announced_at',
        'finished_at',
        'results_published_at',
        'created_at',
        'updated_at',
    ];

    public static $filterable = ['typologies'];

    public function getUrlAttribute(): string
    {
        // @TODO
        return $this->id; //route('contests.detail', [$this->id, $this->slug]);
    }

    public function typologies()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', '');
    }

}
