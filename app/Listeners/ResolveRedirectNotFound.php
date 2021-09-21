<?php

namespace App\Listeners;

use App\Models\Page;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\MissingPageRedirector\Events\RedirectNotFound;

class ResolveRedirectNotFound
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RedirectNotFound  $event
     * @return void
     */
    public function handle(RedirectNotFound $event)
    {
        $slug = last($event->request->segments());
        $page = Page::where('wp_post_name', $slug)->first();
        if ($page) {
            return abort(redirect($page->url)); // because it doesn't work without abort
        }
    }
}
