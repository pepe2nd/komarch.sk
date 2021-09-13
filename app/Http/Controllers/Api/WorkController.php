<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use App\Models\Architect;
use App\Models\Work;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $works = $this->loadWorks($request);

        // search
        if ($request->filled('q')) {
            $works->whereIn('id', Work::search("{$request->query('q')}*")->keys());
        }

        // sort
        $works->orderBy(
            $request->input('sortby', 'created_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int) $request->get('per_page', 8);
        return WorkResource::collection($works->paginate($per_page));
    }

    public function filters(Request $request)
    {
        $works = $this->loadWorks($request)->get();
        $filters = collect();
        foreach (Work::$filterable as $filter) {
            $filters[$filter] = $works->pluck($filter)->flatten()->countBy('name');
        }
        $filters['investors'] = [
            trans('works.public') => $works->where('has_public_investor', true)->count(),
            trans('works.private') => $works->where('has_public_investor', false)->count(),
        ];
        $filters['location_districts'] = $this->getLocationDistricts($request);
        return $filters;
    }

    private function loadWorks(Request $request)
    {
        $works = Work::query();

        // filter by architect
        if ($request->has('architect_id')) {
            $architect = Architect::findOrFail($request->input('architect_id'));
            $works = $architect->works();
        }

        // filter by awards
        if ($request->has('awards')) {
            $works->whereHas('awards', function (Builder $query) use ($request) {
                $query->whereIn('name', $request->input('awards', []));
            });
        }

        $works->with(['media', 'other_architects', 'architects']);

        // apply filters
        if ($request->has('typologies')) {
            $works->withAnyTags($request->input('typologies', []));
        }

        $investor = implode($request->input('investors', []));
        switch ($investor) {
            case trans('works.public'):
                $works->where('has_public_investor', true);
                break;
            case trans('works.private'):
                $works->where('has_public_investor', false);
                break;
        }

        if ($request->has('year_from')) {
            $works->where('date_construction_start', '>=', $request->input('year_from'));
        }

        if ($request->has('year_until')) {
            $works->where('date_construction_ending', '<=', $request->input('year_until'));
        }

        if ($request->has('with_gps')) {
            $works->whereNotNull('location_lat');
            $works->whereNotNull('location_lng');
        }

        return $works;
    }

    private function getLocationDistricts(Request $request)
    {
        $districts_with_count = $this->loadWorks($request)
            ->groupBy('location_district')
            ->select('location_district')
            ->selectRaw('count(*) as count')
            ->whereNotNull('location_district')
            ->orderBy('count', 'desc')
            ->get()
            ->pluck('count', 'location_district')->toArray();

        return array_merge(
            [
                'BL' => 0,
                'ZI' => 0,
                'TC' => 0,
                'PV' => 0,
                'KI' => 0,
                'NI' => 0,
                'TA' => 0,
                'BC' => 0,
            ],
            $districts_with_count,
        );
    }
}
