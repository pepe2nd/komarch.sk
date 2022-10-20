<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Contest;
use App\Http\Resources\ContestResource;
use App\Http\Resources\MediaResource;

class ContestController extends Controller
{
    public function index(Request $request)
    {
        $contests = $this->loadContests($request);

        $contests->with('nextProposal');

        // search
        if ($request->filled('q')) {
            $contests->whereIn('contests.id', Contest::search("*{$request->query('q')}*")->keys());;
        }

        // sort
        $contests->orderBy(
            $request->input('sortby', 'finished_at'),
            $request->input('direction', 'asc')
        );

        $per_page = (int)min($request->get('per_page', 20), 100);
        return ContestResource::collection($contests->paginate($per_page));
    }

    public function filters(Request $request)
    {
        // get all
        $all_contests = Contest::all();
        $filters = collect();
        foreach (Contest::$filterable as $filter) {
            $filters[$filter] = $all_contests->pluck($filter)->flatten()->countBy('name')->sortDesc()->
            mapWithKeys(function ($item, $key) {
                return [$key => 0];
            });
        }

        // get counts for current query
        $contests = $this->loadContests($request)->get();
        foreach (Contest::$filterable as $filter) {
            $filters[$filter] = $filters[$filter]->merge($contests->pluck($filter)->flatten()->countBy('name'))->take(5);
        }
        return $filters;
    }

    private function loadContests(Request $request)
    {
        $contests = Contest::query()->leftJoin('proposals as p', function ($join) {
            $join->on('p.contest_id', '=', 'contests.id')
                ->on(
                    'p.date',
                    '=',
                    DB::raw('(select min(date) from proposals where contest_id = p.contest_id)')
                );
        })->select('contests.*', 'p.date as deadline_at');

        switch ($request->get('state')) {
            case 'upcoming':
                $contests->upcoming();
                break;

            case 'finished':
                $contests->finished();
                break;

            default:
                $contests->ongoing();
                break;
        }
        
        // apply filters
        if ($request->has('typologies')) {
            $contests->withAnyTags($request->input('typologies', []));
        }

        return $contests;
    }

}
