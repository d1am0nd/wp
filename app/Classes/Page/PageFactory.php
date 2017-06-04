<?php

namespace App\Classes\Page;

use App\Classes\Page\Video;
use App\Classes\Page\Channel;
use App\Classes\Page\Website;
use App\Classes\Page\PageTypeHelper;

class PageFactory
{
    public static function create($url)
    {
        $ph = new PageTypeHelper($url);

        if($ph->isYoutubeVideo())
            return new Video($url);
        else if($ph->isYoutubeChannel())
            return new Channel($url);
        else
            return new Website($url);
    }
}
