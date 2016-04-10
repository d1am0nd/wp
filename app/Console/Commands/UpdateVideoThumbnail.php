<?php

namespace App\Console\Commands;

use App\Video;
use App\Classes\Youtube;
use Illuminate\Console\Command;
use App\Classes\Parsers\HtmlParser;

class UpdateVideoThumbnail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:updateThumbnail {id : Id of the video database record} 
    {url : URL of the new video}
    {--queue=default}';
    private $arrContextOptions, $id, $url, $videoId;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates Youtube video information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Set global variables
        if(!env('VERIFY_SSL', true)){
            $this->arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  
        }
        $this->id = $this->argument('id');
        $this->url = $this->argument('url');
        $this->videoId = $this->getVideoId();

        // If video thumbnail is found use this
        // else find channel thumbnail
        if($this->videoId === false)
            $thumbnailUrl = $this->channelThumbnailUrl();
        else{
            $thumbnailUrl = $this->videoThumbnailUrl();
        }
        
        $fileName = '/thumbnails/videos/' . $this->id . '.jpg';
        $absolutePath = public_path() . $fileName;

        $this->videoUpdateArray = ['thumbnail_path' => $fileName];

        // Save thumbnail to public/thumbnails
        file_put_contents($absolutePath, file_get_contents($thumbnailUrl, false, stream_context_create($this->arrContextOptions)));
        $img = \Image::make($absolutePath)->resize(480, 280);
        $img->save($absolutePath);

        $this->videoUpdateArray = array_merge($this->videoUpdateArray, $this->videoUpdateArray());

        Video::where('id', $this->id)->update($this->videoUpdateArray);
    }

    private function videoThumbnailUrl()
    {
        if($this->videoId === false)
            return false;
        $thumbnailUrl = 'http://img.youtube.com/vi/' . $this->videoId . '/0.jpg';
        return $thumbnailUrl;
    }

    // Get youtube id from video or false if url is not video
    private function getVideoId()
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->url, $match);
        if(!isset($match[1]))
            return false;
        return $match[1];
    }

    private function videoUpdateArray()
    {
        if($this->videoId === false)
            return [];

        $returnArray = [];

        $publishedAt = $this->getVideoPublishedAt();
        if($publishedAt !== false)
            $returnArray = array_merge($returnArray, ['published_at' => $publishedAt]);
        $returnArray = array_merge($returnArray, ['embed_url' => 'https://www.youtube.com/embed/' . $this->videoId]);
        return $returnArray;
    }

    private function getVideoPublishedAt()
    {
        // Gets publishedAt attribute with Youtube API
        $video = new Youtube();
        $result = $video->getVideoInfo($this->videoId);
        $publishedAt = $result->snippet->publishedAt;
        if(isset($publishedAt))
            return \Carbon\Carbon::parse($publishedAt);
        return false;
    }

    private function channelThumbnailUrl()
    {
        $htmlParser = new HtmlParser($this->url);
        return $htmlParser->getDomAttVal('meta', 'property', 'og:image', 'content');
    }
}
