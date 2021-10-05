<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use App\Models\Architect;
use App\Models\CitationPublication;
use App\Models\Work;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $works = Work::query()
            ->filtered($request)
            ->with(['media', 'architects', 'awards'])
            ->withCount('awards', 'citationPublications');

        if ($request->has('sortby')) {
            $works->orderBy(
                $request->input('sortby', 'created_at'),
                $request->input('direction', 'desc')
            );
        }

        $works->orderBy('awards_count', 'desc');
        $works->orderBy('citation_publications_count', 'desc');
        $works->orderBy('has_public_investor', 'desc');
        $works->orderBy('has_valuable_social_function', 'desc');

        $per_page = (int) $request->get('per_page', 8);
        return WorkResource::collection($works->paginate($per_page));
    }

    public function related($id, Request $request)
    {
        $per_page = (int) $request->get('per_page', 8);
        $related_works = Work::boolSearch($id)
            ->must(
                'more_like_this',
                [
                    'fields' => ['name', 'location_city'],
                    'like' => [
                        '_id' => $id
                    ],
                    'min_term_freq' => 1,
                    'min_doc_freq' => 1,
                ])
            ->paginate($per_page);

        $related_works->setCollection($related_works->models()->load(['media', 'architects', 'awards']));
        return WorkResource::collection($related_works);
    }

    public function filters(Request $request)
    {
        $works = Work::query()
            ->filtered($request)
            ->with('typologies')
            ->get();

        $filters = collect();
        foreach (Work::$filterable as $filter) {
            $filters[$filter] = $works->pluck($filter)->flatten()->countBy('name');
        }
        $filters['investors'] = [
            trans('works.public') => $works->where('has_public_investor', true)->count(),
            trans('works.private') => $works->where('has_public_investor', false)->count(),
        ];
        $filters['location_districts'] = $this->getLocationDistricts($request);
        $filters['citations'] = $this->getCitations($request);
        return $filters;
    }

    private function getLocationDistricts(Request $request)
    {
        $districts_with_count = Work::filtered($request)
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

    private function getCitations(Request $request)
    {

        // get all
        $all_publications = CitationPublication::all()->flatMap(fn ($row) => [$row->publication_name => 0])
            ->toArray();

        // get counts for  current query
        $filtered_publications =  CitationPublication::query()
            ->whereHas('works', function (Builder $query) use ($request) {
                $query->filtered($request);
            })
            ->select('publication_name')
            ->selectRaw('count(*) as count')
            ->groupBy('publication_name')
            ->get()
            ->flatMap(fn ($row) => [$row->publication_name => $row->count])
            ->toArray();

        return array_merge(
            $all_publications,
            $filtered_publications,
        );
    }
}
