<?php

namespace App\Listeners;

use App\Events\BlogPostPublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogPostPublishedListener
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
     * @param  BlogPostPublished  $event
     * @return void
     */
    public function handle(BlogPostPublished $event)
    {
        //
        //dd($event);
    }
}
