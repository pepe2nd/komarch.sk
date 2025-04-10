<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Architect;
use Illuminate\Http\Request;

class ArchitectsController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::findOrFail(327); // legacy page "Architekti"
        return view('architects.index', compact('page'));
    }

    public function show($id, $slug, Request $request)
    {
        $architect = Architect::with('address', 'number')->findOrFail($id);

        if ($slug != $architect->slug) {
            return redirect($architect->url);
        }

        return view('architects.show', compact('architect'));
    }
}
