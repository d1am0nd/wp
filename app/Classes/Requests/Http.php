<?php

namespace App\Classes\Requests;

class Http
{
    protected $arrContextOptions, $url;

    public function __construct($url)
    {
        $this->url = $url;

        if(!env('VERIFY_SSL', true)){
            $this->arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  
        }
    }

    public function downloadImage($absolutePath)
    {
        return file_put_contents($absolutePath, $this->getContent()) ? true : false;
    }

    public function getHtml()
    {
        return $this->getContent();
    }

    private function getContent()
    {
        return file_get_contents($this->url, false, stream_context_create($this->arrContextOptions));
    }
}
