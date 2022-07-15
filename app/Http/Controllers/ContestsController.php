<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Contest;
use Illuminate\Http\Request;

class ContestsController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::findOrFail(340); // legacy page "Súťaže"
        return view('contests.index', compact('page'));
    }

    public function show($id, $slug, Request $request)
    {
        $contest = Contest::findOrFail($id);

        if ($slug != $contest->slug) {
            return redirect($contest->url);
        }

        return view('contests.show', compact('contest'));
    }
}
