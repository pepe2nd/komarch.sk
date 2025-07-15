<?php

namespace App\Http\Controllers\Api;

use App\Models\Number;
use App\Models\Architect;
use App\Models\PostOffice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class ArchitectFiltersController extends Controller
{
    public function index(Request $request)
    {
        return [
            'startsWith' => $this->getStartsWith($request),
            'authorizationsIn' => $this->getAuthorizationsIn($request),
            'regions' => $this->getRegions($request),
            'districts' => $this->getDistricts($request)
        ];
    }

    private function getStartsWith(Request $request)
    {
        $architectsFirstLetters = Architect::query()
            ->filtered($request)
            ->selectRaw('LEFT(last_name, 1) AS first_letter')
            ->groupBy('first_letter')
            ->pluck('first_letter')
            ->flatMap(fn ($letter) => [
                (string) Str::of($letter)->ascii() => true
            ]);

        $startsWith = [];
        foreach (range('A', 'Z') as $letter) {
            $startsWith[$letter] = $architectsFirstLetters->has($letter);
        }

        return $startsWith;
    }

    private function getAuthorizationsIn(Request $request)
    {
        $counts = Number::query()
            ->whereHas('architect', function (Builder $query) use ($request) {
                $query->filtered($request);
            })
            ->selectRaw("SUBSTRING_INDEX(TRIM(architect_number), ' ', -1) as authorization_type")
            ->selectRaw('count(*) as count')
            ->groupBy('authorization_type')
            ->get()
            ->flatMap(fn ($row) => [$row->authorization_type => $row->count])
            ->toArray();

        return array_merge(
            [
                'AA' => 0,
                'KA' => 0,
                'HA' => 0,
                'HKA' => 0,
                'PR' => 0,
                'EA' => 0,
                'C' => 0,
                'Z' => 0,
            ],
            $counts,
        );
    }

    function getRegions(Request $request)
    {
        $all_regions = Architect::query()
            ->join('addresses', 'addresses.architect_id', '=', 'architects.id')
            ->join('post_offices', 'post_offices.psc', '=', 'addresses.location_postal_code')
            ->groupBy('post_offices.kraj')
            ->select(DB::raw('count(distinct(architects.id)) as architect_count, post_offices.kraj'))
            ->orderBy('architect_count', 'desc')
            ->get()
            ->flatMap(fn ($row) => [$row->kraj => 0])->toArray();

        $filtered_regions = Architect::query()
            ->filtered($request)
            ->join('addresses', 'addresses.architect_id', '=', 'architects.id')
            ->join('post_offices', 'post_offices.psc', '=', 'addresses.location_postal_code')
            ->groupBy('post_offices.kraj')
            ->select(DB::raw('count(distinct(architects.id)) as architect_count, post_offices.kraj'))
            ->orderBy('architect_count', 'desc')
            ->get()
            ->pluck('architect_count', 'kraj')->toArray();

        return array_merge(
            $all_regions,
            $filtered_regions,
        );
    }

    function getDistricts(Request $request)
    {
        if (empty($request->get('regions'))) {
            return [];
        }

        $all_districts = Architect::query()
            ->join('addresses', 'addresses.architect_id', '=', 'architects.id')
            ->join('post_offices', 'post_offices.psc', '=', 'addresses.location_postal_code')
            ->whereIn('post_offices.kraj', $request->get('regions', []))
            ->groupBy('post_offices.okres')
            ->select(DB::raw('count(distinct(architects.id)) as architect_count, post_offices.okres'))
            ->orderBy('architect_count', 'desc')
            ->get()
            ->flatMap(fn ($row) => [$row->okres => 0])
            ->reject(function ($value, $key) {
                return empty($key);
            })->toArray();

        $filtered_districts = Architect::query()
            ->filtered($request)
            ->join('addresses', 'addresses.architect_id', '=', 'architects.id')
            ->join('post_offices', 'post_offices.psc', '=', 'addresses.location_postal_code')
            ->whereIn('post_offices.kraj', $request->get('regions', []))
            ->groupBy('post_offices.okres')
            ->select(DB::raw('count(distinct(architects.id)) as architect_count, post_offices.okres'))
            ->orderBy('architect_count', 'desc')
            ->get()
            ->pluck('architect_count', 'okres')
            ->reject(function ($value, $key) {
                return empty($key);
            })->toArray();

        return array_merge(
            $all_districts,
            $filtered_districts,
        );
    }
}
