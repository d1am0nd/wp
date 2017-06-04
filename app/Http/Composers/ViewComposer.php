<?php

namespace App\Http\Composers;

use App\Tag;
use App\Video;
use App\Page;
use Illuminate\Contracts\View\View;

class ViewComposer
{
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        /*
        $latestPages = Page::orderBy('created_at', 'DESC')->take(3)->get();
        $latestVideos = Video::orderBy('created_at', 'DESC')->take(3)->get();
        $tags = Tag::get();
        $view->with(compact('latestPages', 'latestVideos', 'tags'));
        */
    }
}
