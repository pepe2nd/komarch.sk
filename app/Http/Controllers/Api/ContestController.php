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
            $contests->whereIn('id', Contest::search("*{$request->query('q')}*")->keys());;
        }

        // sort
        $contests->orderBy(
            $request->input('sortby', 'created_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int)min($request->get('per_page', 8), 100);
        return ContestResource::collection($contests->paginate($per_page));
    }

    public function filters(Request $request)
    {
        $contests = $this->loadContests($request)->get();
        $filters = collect();
        $filters['status'] = [
            'ongoing' => $contests->where('status', 'ongoing')->count(),
            'upcoming' => $contests->where('status', 'upcoming')->count(),
            'finished' => $contests->where('status', 'finished')->count(),
        ];
        foreach (Contest::$filterable as $filter) {
            $filters[$filter] = $contests->pluck($filter)->flatten()->countBy('name');
        }
        return $filters;
    }

    private function loadContests(Request $request)
    {
        $contests = Contest::query();

        // apply filters
        if ($request->has('typologies')) {
            $contests->withAnyTags($request->input('typologies', []));
        }

        if ($request->has('ongoing')) {
            $contests->ongoing();
        }

        if ($request->has('upcoming')) {
            $contests->upcoming();
        }

        if ($request->has('finished')) {
            $contests->finished();
        }

        return $contests;
    }

}
