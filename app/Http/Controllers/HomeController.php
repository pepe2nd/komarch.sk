<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use App\Models\Post;
use App\Models\Publication;
use App\Models\Tile;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search('*')->orderBy('published_at', 'desc');
        $posts = $posts->take(4)->get();
        $featured_post = Post::inRandomOrder()->first();
        $publications = Publication::published()->orderBy('published_at','desc')->take(2)->get();
        $videos = Video::published()->orderBy('published_at','desc')->take(3)->get();
        $tiles = Tile::published()->orderBy('published_at', 'desc')->get();
        $contestFilterOptions = [
            ['key' => 'ongoing', 'title' => trans('contests.ongoing')],
            ['key' => 'upcoming', 'title' => trans('contests.upcoming')],
            ['key' => 'finished', 'title' => trans('contests.finished')],
        ];

        $deadline = Deadline::published()->due()->orderBy('published_at', 'desc')->first();

        return view('home', compact('posts', 'featured_post', 'publications', 'videos', 'deadline', 'tiles', 'contestFilterOptions'));
    }
}
