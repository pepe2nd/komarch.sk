<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Document;
use App\Http\Resources\DocumentResource;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = $this->loadDocuments($request);

        // search
        if ($request->filled('q')) {
            $documents->whereIn('id', Document::search($request->query('q'))->keys());
        }

        // sort
        $documents->orderBy(
            $request->input('sortby', 'created_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int)min($request->get('per_page', 10), 15);
        return DocumentResource::collection($documents->paginate($per_page));
    }

    public function filters(Request $request)
    {
        $documents = $this->loadDocuments($request)->get();
        $filters = collect();
        foreach (Document::$filterable as $filter) {
            $filters[$filter] = $documents->pluck($filter)->flatten()->countBy('name');
        }
        return $filters;
    }

    public function download($id, Request $request)
    {
        return Document::find($id)->increment('download_count');
    }

    private function loadDocuments(Request $request)
    {
        $documents = Document::query();

        // apply filters
        if ($request->has('types')) {
            $documents->withAnyTags($request->input('types', []), 'document-type');
        }
        if ($request->has('topics')) {
            $documents->withAnyTags($request->input('topics', []), 'document-topic');
        }
        if ($request->has('roles')) {
            $documents->withAnyTags($request->input('roles', []), 'document-role');
        }

        return $documents;
    }
}
