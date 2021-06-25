<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contest;
use App\Http\Resources\ContestResource;
use App\Http\Resources\MediaResource;

class ContestController extends Controller
{
    public function index(Request $request)
    {
        $contests = $this->loadContests($request);

        // search
        if ($request->filled('q')) {
            $contests->where('title', 'like', '%' .$request->input('q') . '%');
        }

        // sort
        $contests->orderBy(
            $request->input('sortby', 'created_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int)min($request->get('per_page', 8), 100);
        return ContestResource::collection($contests->paginate($per_page));
    }

    private function loadContests(Request $request)
    {
        $contests = Contest::query();

        // apply filters
        if ($request->has('tags')) {
            $contests->withAnyTags($request->input('tags', []));
        }

        return $contests;
    }

}
