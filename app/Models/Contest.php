<?php

namespace App\Models;

use App\Models\Architect;
use App\Models\Juror;
use App\Models\Proposal;
use App\Models\Reward;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Contest extends Model implements HasMedia
{
    use CrudTrait;
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;
    use Searchable;

    public $incrementing = false;

    protected $dates = [
        'announced_at',
        'approved_at',
        'finished_at',
        'results_published_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['state'];

    public static $filterable = ['typologies'];

    public function getUrlAttribute(): string
    {
        return route('contests.detail', [$this->id, $this->slug]);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }

    public function getCoverImageAttribute()
    {
        return $this->getFirstMedia('contest_pictures');
    }

    public function getAttachmentsAttribute()
    {
        return $this->getMedia('contest_attachments');
    }

    public function getStateAttribute()
    {
        if (is_null($this->announced_at) || $this->announced_at->isFuture()) {
            return 'upcoming';
        } 
        if (is_null($this->finished_at) || $this->finished_at->isFuture()) {
            return 'ongoing';
        }

        return 'finished';
    }

    public function getFullNumberAttribute()
    {
        return "KA-" . $this->file_number_serial . "/" . $this->file_number_year;
    }

    public function getInVerificationAttribute()
    {
        return empty($this->approved_at);
    }

    public function typologies()
    {
        return $this->morphToMany(Tag::class, 'taggable')->whereNull('type');
    }

    public function scopeOngoing($query)
    {
        return $query->whereDate('announced_at', '<=', Carbon::now())
            ->whereDate('p.date', '>=', Carbon::now());
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('announced_at', '>', Carbon::now())
            ->orWhereNull('announced_at');
    }

    public function scopeFinished($query)
    {
        // return $query->whereDate('finished_at', '<', Carbon::now()); // might return back soon :P
        return $query->whereDate('announced_at', '<', Carbon::now())
            ->whereDate('p.date', '<', Carbon::now());
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('contest_pictures')
            ->withResponsiveImages();

        $this
            ->addMediaCollection('contest_attachments');
    }

    public function toSearchableArray()
    {
        return Arr::only($this->toArray(), ['title', 'perex']);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function nextProposal()
    {
        return $this->hasOne(Proposal::class)->orderBy('date', 'asc');
    }

    public function jurors()
    {
        return $this->hasMany(Juror::class);
    }

    public function architects()
    {
        return $this->belongsToMany(Architect::class)->withPivot('depended', 'type');
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class)->orderBy('order');
    }

    public function results()
    {
        return $this->hasManyThrough(Contestresult::class, Reward::class);
    }

    public function getDatesFormatedAttribute()
    {
        if ($this->in_verification) {
            return trans('contests.in_verification');
        } elseif ($this->nextProposal && $this->nextProposal->date) {
            return $this->announced_at->format(config('settings.date_short_without_year_format')) . ' – ' . $this->nextProposal->date->format(config('settings.date_short_format'));
        } elseif ($this->finished_at) {
            return $this->announced_at->format(config('settings.date_short_without_year_format')) . ' – ' . $this->finished_at->format(config('settings.date_short_format'));
        } else {
            return $this->announced_at->format(config('settings.date_short_format'));
        }
    } 

}
