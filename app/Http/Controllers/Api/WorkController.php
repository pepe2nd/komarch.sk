<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Work;
use App\Models\Architect;
use App\Http\Resources\WorkResource;

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
        $filters['has_public_investor'] = [
            trans('works.public') => $works->where('has_public_investor', true)->count(),
            trans('works.private') => $works->where('has_public_investor', false)->count(),
        ];
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

        $works->with(['media', 'other_architects', 'architects']);

        // apply filters
        if ($request->has('tags')) {
            $works->withAnyTags($request->input('tags', []));
        }

        if ($request->has('has_public_investor')) {
            $works->where('has_public_investor', '=', $request->input('has_public_investor'));
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
}
