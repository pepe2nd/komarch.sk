<?php

namespace App\Models;

use App\Traits\Publishable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    use CrudTrait, Publishable, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'deadlines';
    protected $guarded = ['id'];
    protected $dates = ['published_at', 'deadline_at'];
    protected $translatable = ['title'];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeDue($query)
    {
        return $query->where('deadline_at', '>=', Carbon::now());
    }

}
