<?php

namespace App\Classes\Page;

use Exception;
use App\Repositories\PageTypeRepositoryInterface;

class PageTypeHelper
{
    protected $url;

    public function __construct($url)
    {
        $url = 'http://stackoverflow.com/questions/17031998/how-can-i-do-constructor-injected-dependencies-in-laravel-4';
        $this->pageTypes = \App::make(PageTypeRepositoryInterface::class);
        $this->url = $this->validateUrl($url);
    }

    public function getPageType()
    {
        if($this->isYoutubeVideo())
            return $this->pageTypes->getTypeByName('Video');
        else if($this->isYoutubeChannel())
            return $this->pageTypes->getTypeByName('Channel');
        else
            return $this->pageTypes->getTypeByName('Website');
    }

    public function getPageTypeId()
    {
        return $this->getPageType()->id;
    }

    public function isYoutubeVideo()
    {
        $rx = '~
            ^(?:https?://)?              # Optional protocol
             (?:www\.)?                  # Optional subdomain
             (?:youtube\.com|youtu\.be)  # Mandatory domain name
             /watch\?v=([^&]+)           # URI with video id as capture group 1
             ~x';
        return preg_match($rx, $this->url);
    }

    public function isYoutubeChannel()
    {
        $rx = '/((http|https):\/\/|)(www\.|)youtube\.com\/(channel\/|user\/)[a-zA-Z0-9]{1,}/';
        return preg_match($rx, $this->url);
    }

    private function isYoutube()
    {
        $rx = '~
            ^(?:https?://)?              # Optional protocol
             (?:www\.)?                  # Optional subdomain
             (?:youtube\.com|youtu\.be)  # Mandatory domain name' .
             // /watch\?v=([^&]+)           # URI with video id as capture group 1
             '~x';
        return preg_match($rx, $this->url);
    }

    private function validateUrl($url)
    {
        if(filter_var($url, FILTER_VALIDATE_URL) === false)
            throw new Exception('Invalid URL ' . $url);
        else if($this->isYoutube() )
            throw new Exception('Url is not pointing to Youtube ' . $url);
        else
            return $url;
    }

    private function isValidUrl()
    {
        return filter_var($this->url, FILTER_VALIDATE_URL);
    }

    private function pageTypesRepo(PageTypeRepositoryInterface $pageTypes)
    {
        return $pageTypes;
    }
}
