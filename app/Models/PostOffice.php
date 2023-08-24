<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    use HasFactory;

    function addresses() {
        return $this->hasMany(Address::class, 'location_postal_code', 'psc');
    }
}
