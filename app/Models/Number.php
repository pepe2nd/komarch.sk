<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Number extends Model
{
    use HasFactory;
    protected $removed = ['C', 'Z'];

    public function getArchitectNumberAttribute()
    {
        if ($this->isRemoved()) {
            return trans('architects.removed');
        }
        return $this->attributes['architect_number'];
    }

    public function isRemoved()
    {
        return in_array($this->attributes['architect_number'], $this->removed);
    }

    public function architect()
    {
        return $this->belongsTo(Architect::class);
    }

    public function getAuthorizationAttribute()
    {
        return Str::of($this->architect_number)->explode(' ')->last();
    }
}
