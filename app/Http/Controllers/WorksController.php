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

    public function show(Work $work)
    {
        return view('works.show', compact('work'));
    }
}
