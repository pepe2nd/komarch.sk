<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ImportFromUrad as ImportFromUradJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ImportFromUrad extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->input('apiKey') !== Config::get('auth.jobs_api_key')) return response('Invalid apiKey provided', 401);

        ImportFromUradJob::dispatch();
    }
}
