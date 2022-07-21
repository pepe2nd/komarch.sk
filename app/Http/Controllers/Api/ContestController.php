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
        $contests = $this->loadContests($request)->leftJoin('proposals as p', function ($join) {
           $join->on('p.contest_id', '=', 'contests.id')
             ->on('p.date', '=',
               DB::raw('(select min(date) from proposals where contest_id = p.contest_id and date >= NOW())'))
             ->whereRaw('p.date >= NOW()');
         })->select('contests.*', 'p.date');

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
        $contests = $this->loadContests($request)->get();
        $filters = collect();
        $filters['states'] = [
            trans('contests.ongoing') => $contests->where('state', 'ongoing')->count(),
            trans('contests.upcoming') => $contests->where('state', 'upcoming')->count(),
            trans('contests.finished') => $contests->where('state', 'finished')->count(),
        ];
        foreach (Contest::$filterable as $filter) {
            $filters[$filter] = $contests->pluck($filter)->flatten()->countBy('name')->sortDesc()->take(5);
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

        if ($request->has('states')) {
            $contests->where(function ($query) use ($request) {
                if (in_array(trans('contests.ongoing'), $request->get('states', []))) {
                    $query->orWhere(function ($q) {
                        $q->ongoing();
                    });
                }
                if (in_array(trans('contests.upcoming'), $request->get('states', []))) {
                    $query->orWhere(function ($q) {
                        $q->upcoming();
                    });
                }
                if (in_array(trans('contests.finished'), $request->get('states', []))) {
                    $query->orWhere(function ($q) {
                        $q->finished();
                    });
                }
            });
        }

        return $contests;
    }

}
