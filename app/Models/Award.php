<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    public function works()
    {
        return $this->belongsToMany(Work::class);
    }
}
