<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Work;
use App\Http\Resources\WorkResource;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $works = $this->loadWorks($request);

        // sort
        $works->orderBy(
            $request->input('sortby', 'created_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int)min($request->get('per_page', 8), 100);
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
            'false' => $works->where('has_public_investor', false)->count(),
            'true' => $works->where('has_public_investor', true)->count(),
        ];
        return $filters;
    }

    private function loadWorks(Request $request)
    {
        $works = Work::query();

        // apply filters
        if ($request->has('tags')) {
            $works->withAnyTags($request->input('tags', []));
        }

        return $works;
    }
}
