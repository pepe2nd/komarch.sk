<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Publication;
use App\Models\Tile;
use Illuminate\Http\Request;

class ContestsController extends Controller
{
    public function index(Request $request)
    {
        return view('contests');
    }
}
