<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Work;
use Illuminate\Http\Request;

class WorksController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::findOrFail(410); // legacy page "Register diel"
        return view('works.index', compact('page'));
    }

    public function show($id, $slug, Request $request)
    {
        $work = Work::findOrFail($id);

        if ($slug != $work->slug) {
            return redirect($work->url);
        }

        return view('works.show', compact('work'));
    }
}
