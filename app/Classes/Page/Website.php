<?php

namespace App\Classes\Page;

use App\Classes\Requests\Http;
use App\Classes\Parsers\HtmlParser;
use App\Classes\Page\PageInterface;

class Website implements PageInterface
{
    protected $url, $html, $htmlParser;

    public function __construct($url) 
    {
        $http = new Http($url);
        $this->url = $url;
        $this->html = $http->getHtml();
        $this->htmlParser = new HtmlParser($this->html); 
    }

    public function getThumbnailUrl()
    {
        return $this->htmlParser->getDomAttVal('meta', 'property', 'og:image', 'content');
    }

    public function getTitle()
    {
        return $this->htmlParser->getTitle();
    }

    public function getDescription()
    {
        return $this->htmlParser->getDomAttVal('meta', 'property', 'og:description', 'content');
    }
}
