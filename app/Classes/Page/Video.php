<?php

namespace App\Classes\Page;

use App\Classes\Youtube;
use App\Classes\Page\PageInterface;

class Video implements PageInterface
{
    protected $url, $videoInfo, $youtube, $id;

    public function __construct($url) 
    {
        $this->url = $url;
        $this->id = $this->getVideoId();
        $this->youtube = new Youtube;
        $this->videoInfo = $this->youtube->getVideoInfo($this->id);
    }

    public function getThumbnailUrl()
    {
        return 'http://img.youtube.com/vi/' . $this->id . '/0.jpg';
    }

    public function getTitle()
    {
        return $this->videoInfo->snippet->title;
    }

    public function getDescription()
    {
        return $this->videoInfo->snippet->description;
    }

    public function getVideoId()
    {
        // http://stackoverflow.com/questions/6556559/youtube-api-extract-video-id
        $pattern = 
            '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x'
            ; 
        $result = preg_match($pattern, $this->url, $matches);
        if ($result) 
            return $matches[1];
        else 
            throw new \Exception('Passed url is not a valid Youtube video');
    }
}
