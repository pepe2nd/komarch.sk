<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Architect;
use App\Models\Contest;
use App\Models\Page;
use App\Models\Post;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchSuggestionController extends Controller
{
    private $limit = 4;
    private $min_length = 2;

    public function index(Request $request)
    {
        $search = $request->get('search', '');

        if (!$search || Str::length($search) < $this->min_length) {
            return [];
        }

        return [
            'architects' => $this->architects($search),
            'works' => $this->works($search),
            'contests' => $this->contests($search),
            'posts' => $this->posts($search),
            'pages' => $this->pages($search),
        ];
    }

    private function architects(string $search)
    {
        $architects = Architect::search("*{$search}*")->take($this->limit)->get();
        return $architects->map->only('id', 'url', 'title');
    }

    private function works(string $search)
    {
        $works = Work::search("*{$search}*")->take($this->limit)->get();
        return $works->map->only('id', 'url', 'title');
    }

    private function contests(string $search)
    {
        $contests = Contest::search("*{$search}*")->take($this->limit)->get();
        return $contests->map->only('id', 'url', 'title');
    }

    private function posts(string $search)
    {
        $posts = Post::search("*{$search}*")->take($this->limit)->get();
        return $posts->map->only('id', 'url', 'title');
    }

    private function pages(string $search)
    {
        $pages = Page::published()->where('title', 'like', "%{$search}%")->take($this->limit)->get();
        return $pages->map->only('id', 'url', 'title');
    }

}
