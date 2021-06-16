<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorksController extends Controller
{
    public function index(Request $request)
    {
        return view('works');
    }
}
