<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitationPublication extends Model
{
    public function works()
    {
        return $this->belongsToMany(
            Work::class,
            'citation_publication_work',
            'publication_id',
            'work_id'
        );
    }
}
