<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use App\Models\Post;
use App\Models\Work;
use App\Models\Contest;
use App\Models\Document;
use App\Models\Architect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;

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
            'documents' => $this->documents($search),
            'pages' => $this->pages($search),
            'contests' => $this->contests($search),
            'works' => $this->works($search),
            'posts' => $this->posts($search),
            'architects' => $this->architects($search),
        ];
    }

    private function architects(string $search)
    {
        $architects = Architect::search($search)->take($this->limit)->get();
        return $architects->map(function ($architect) {
            return [
                'id' => $architect->id,
                'url' => $architect->url,
                'title' => $architect->full_name,
            ];
        });
    }

    private function works(string $search)
    {
        $works = Work::search($search)->take($this->limit)->get();
        return $works->map(function ($work) {
            return [
                'id' => $work->id,
                'url' => $work->url,
                'title' => $work->name,
            ];
        });
    }

    private function contests(string $search)
    {
        $contests = Contest::search($search)->take($this->limit)->get();
        return $contests->map->only('id', 'url', 'title');
    }

    private function posts(string $search)
    {
        $posts = Post::search($search)->take($this->limit)->get();
        return $posts->map->only('id', 'url', 'title');
    }

    private function pages(string $search)
    {
        $pages = Page::search($search)->take($this->limit)->get();
        return $pages->map->only('id', 'url', 'title');
    }

    private function documents(string $search)
    {
        $documents = Document::search($search)->take($this->limit)->get();
        return $documents->map(function ($document) {
            return [
                'id' => $document->id,
                'url' => $document->url,
                'title' => $document->name
            ];
        });
    }
}
