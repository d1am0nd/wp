<?php

namespace App\Classes\Page;

use App\Classes\Page\Website;
use App\Classes\Page\PageInterface;

class Channel implements PageInterface
{
    protected $website;

    public function __construct($url) 
    {
        $this->website = new Website($url);
    }

    public function getThumbnailUrl()
    {
        return $this->website->getThumbnailUrl();
    }

    public function getTitle()
    {
        return $this->website->getTitle();
    }

    public function getDescription()
    {
        return $this->website->getDescription();
    }
}
