<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Number extends Model
{
    use HasFactory;
    protected static $removed = ['C', 'Z'];

    public function getArchitectNumberAttribute()
    {
        if (self::isRemoved($this->attributes['architect_number'])) {
            return trans('architects.removed');
        }
        return $this->attributes['architect_number'];
    }

    public static function isRemoved($number)
    {
        return in_array($number, self::$removed);
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
