<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorksController extends Controller
{
    public function index(Request $request)
    {
        return view('works.index');
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
