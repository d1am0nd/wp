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
        $tags = Tag::get();
        if(!$view->offsetExists('pages'))
            $pages = Page::take(5)->get();
        if(!$view->offsetExists('videos'))
            $videos = Video::take(5)->get();
        $view->with(compact('pages', 'videos', 'tags'));
    }
}