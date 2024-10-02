<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Page;
use App\Models\Post;
use App\Models\Work;
use App\Models\Contest;
use App\Models\Document;
use App\Models\Architect;
use Tests\RefreshSearchIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchSuggestionTest extends TestCase
{
    use RefreshDatabase, RefreshSearchIndex;

    /** @test */
    public function it_returns_search_suggestions_for_posts()
    {
        Post::factory()->published()->create(['title' => 'Searchable Post']);

        $response = $this->getJson(route('search-suggestions', ['search' => 'Searchable']));

        $response->assertOk()
            ->assertJsonFragment(['title' => 'Searchable Post']);
    }

    public function it_returns_search_suggestions_for_pages()
    {
        Page::factory()->create(['title' => 'Searchable Page']);

        $response = $this->getJson(route('search-suggestions', ['search' => 'Searchable']));

        $response->assertOk()
            ->assertJsonFragment(['title' => 'Searchable Page']);
    }

    /** @test */
    public function it_returns_search_suggestions_for_works()
    {
        Work::factory()->create(['name' => 'Searchable Work']);

        $response = $this->getJson(route('search-suggestions', ['search' => 'Searchable']));

        $response->assertOk()
            ->assertJsonFragment(['title' => 'Searchable Work']);
    }

    /** @test */
    public function it_returns_search_suggestions_for_contests()
    {
        Contest::factory()->create(['title' => 'Searchable Contest']);

        $response = $this->getJson(route('search-suggestions', ['search' => 'Searchable']));

        $response->assertOk()
            ->assertJsonFragment(['title' => 'Searchable Contest']);
    }

    /** @test */
    public function it_returns_search_suggestions_for_documents()
    {
        Document::factory()->create(['name' => 'Searchable Document']);

        $response = $this->getJson(route('search-suggestions', ['search' => 'Searchable']));

        $response->assertOk()
            ->assertJsonFragment(['title' => 'Searchable Document']);
    }

    /** @test */
    public function it_returns_search_suggestions_for_architects()
    {
        Architect::factory()->create([
            'title_before' => 'Ing.arch.',
            'first_name' => 'Searchable',
            'last_name' => 'Architect'
        ]);
        $response = $this->getJson(route('search-suggestions', ['search' => 'Searchable']));
        $response->assertOk()
            ->assertJsonFragment(['title' => 'Ing.arch. Searchable Architect']);
    }

    /** @test */
    public function it_returns_empty_array_if_search_query_is_too_short()
    {
        $response = $this->getJson(route('search-suggestions', ['search' => 'S']));

        $response->assertOk()
            ->assertExactJson([]);
    }

    /** @test */
    public function it_returns_empty_array_if_no_search_term_provided()
    {
        $response = $this->getJson(route('search-suggestions'));

        $response->assertOk()
            ->assertExactJson([]);
    }

    /** @test */
    public function it_returns_search_results_in_correct_order()
    {
        Document::factory()->create(['name' => 'Searchable Document']);
        Page::factory()->create(['title' => 'Searchable Page']);
        Contest::factory()->create(['title' => 'Searchable Contest']);
        Work::factory()->create(['name' => 'Searchable Work']);
        Post::factory()->create(['title' => 'Searchable Post']);
        Architect::factory()->create(['first_name' => 'Searchable','last_name' => 'Architect']);

        $response = $this->getJson(route('search-suggestions', ['search' => 'Searchable']));

        $response->assertOk()
            ->assertJsonStructure([
                'documents',
                'pages',
                'contests',
                'works',
                'posts',
                'architects',
            ]);
        }
}
