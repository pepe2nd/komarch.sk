<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Contest extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasTags;

    public function getUrlAttribute(): string
    {
        // @TODO
        return $this->id; //route('contests.detail', [$this->id, $this->slug]);
    }
}
