<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasShortDescription
{
    public function shortenString($str, $limit = 280, $end = '...')
    {
        $short_description = str_replace(array("\r", "\n"), '', strip_tags($str));
        return Str::limit($short_description, $limit, '...');
    }
}
