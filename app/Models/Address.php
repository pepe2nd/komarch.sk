<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function getFormatedAttribute()
    {
        return collect([
            $this->location_street . ' ' . $this->location_descriptive_number,
            $this->location_city,
            $this->location_country
        ])->filter()->join(', ');
    }

    function district() {
        return $this->hasOne(PostOffice::class, 'psc', 'location_postal_code');
    }
}
