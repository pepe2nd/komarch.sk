<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = $this->loadPosts($request);

        // sort
        $posts->orderBy(
            $request->input('sortby', 'published_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int)min($request->get('per_page', 6), 15);
        return PostResource::collection($posts->paginate($per_page));
    }

    public function filters(Request $request)
    {
        $categories = \App\Models\Tag::withCount('posts')
                    ->orderBy('posts_count', 'desc')->get()
                    ->filter(function ($tag) {
                        return ($tag->posts_count > 0);
                    })->pluck('posts_count', 'name');

        return collect(['categories' => $categories]);
    }

    public function related($id, Request $request)
    {
        $related = Post::take(10)->inRandomOrder()->get();
        return PostResource::collection($related);
    }

    private function loadPosts(Request $request)
    {
        $posts = Post::published();

        // apply filters
        if ($request->has('categories')) {
            $posts->withAnyTags($request->input('categories', []));
        }
        if ($request->has('featured')) {
            $posts->featured();
        }

        return $posts;
    }
}
