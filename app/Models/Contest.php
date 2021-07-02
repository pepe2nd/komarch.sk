<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Illuminate\Support\Carbon;

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

    public function scopeOngoing($query)
    {
        return $query->whereDate('announced_at', '<', Carbon::now())
            ->where(function ($subquery) {
                $subquery->whereDate('finished_at', '>', Carbon::now())
                    ->orWhereNull('finished_at');
        });
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('announced_at', '>', Carbon::now());
    }

    public function scopeFinished($query)
    {
        return $query->whereDate('finished_at', '<', Carbon::now());
    }

}
