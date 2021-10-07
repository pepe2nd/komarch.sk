<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Number extends Model
{
    use HasFactory;
    protected static $removed = ['C', 'Z'];

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
