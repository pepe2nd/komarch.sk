<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class ContestsController extends Controller
{
    public function index(Request $request)
    {
        return view('contests');
    }

    public function show($id, $slug, Request $request)
    {
        $contest = Contest::findOrFail($id);

        if ($slug != $contest->slug) {
            return redirect($contest->url);
        }

        return true; //view('contests.show', compact('contest'));
    }
}
