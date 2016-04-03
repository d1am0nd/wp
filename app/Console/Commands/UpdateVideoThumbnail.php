<?php

namespace App\Console\Commands;

use App\Video;
use App\Classes\Youtube;
use Illuminate\Console\Command;

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
    private $arrContextOptions, $id, $url;

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

        $this->url = $this->argument('url');

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
        $this->videoUpdateArray = [];

        // If video thumbnail is found use this
        // else find channel thumbnail
        $thumbnailUrl = $this->videoThumbnailUrl();
        if($thumbnailUrl === false){
            $thumbnailUrl = $this->channelThumbnailUrl();
        }else{;
        }

        $this->line($thumbnailUrl);
        
        $fileName = '/thumbnails/videos/' . $this->id . '.jpg';
        $absolutePath = public_path() . $fileName;

        // Save thumbnail to public/thumbnails
        file_put_contents($absolutePath, file_get_contents($thumbnailUrl, false, stream_context_create($this->arrContextOptions)));
        $img = \Image::make($absolutePath)->resize(480, 280);
        $img->save($absolutePath);

        $this->videoUpdateArray = array_merge($this->videoUpdateArray, ['thumbnail_path' => $fileName]);

        $this->info(print_r($this->videoUpdateArray));

        Video::where('id', $this->id)->update($this->videoUpdateArray);
    }

    protected function videoThumbnailUrl()
    {
        // Get thumbnail url from video
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->url, $match);
        if(!isset($match[1]))
            return false;
        $ytId = $match[1];
        // Ugly, this should be separated 
        // TODO: this
        $this->videoUpdateArray = array_merge($this->videoUpdateArray, ['embed_url' => 'https://www.youtube.com/embed/' . $ytId]);
        $this->videoUpdateArray = array_merge($this->videoUpdateArray, $this->videoUpdateArray($ytId));
        $thumbnailUrl = 'http://img.youtube.com/vi/' . $ytId . '/0.jpg';
        return $thumbnailUrl;
    }

    protected function videoUpdateArray($ytId)
    {
        // Gets publishedAt attribute with Youtube API
        $returnArray = [];
        $video = new Youtube();
        $result = $video->getVideoInfo($ytId);
        $publishedAt = $result->snippet->publishedAt;
        if(isset($publishedAt)){
            $publishedAt = \Carbon\Carbon::parse($publishedAt);
            $returnArray = array_merge($returnArray, ['published_at' => $publishedAt]);
        }
        return $returnArray;
    }

    protected function channelThumbnailUrl()
    {
        try{
            // Get og tags from url
            libxml_use_internal_errors(true);
            $doc = new \DomDocument();
            $doc->loadHTML(file_get_contents($this->url, false, stream_context_create($this->arrContextOptions)));
            $xpath = new \DOMXPath($doc);
            $query = '//*/meta[starts-with(@property, \'og:image\')]';
            $metas = $xpath->query($query);

            foreach ($metas as $meta) {
                $property = $meta->getAttribute('property');
                if($property == "og:image"){
                    $thumbnailUrl = $meta->getAttribute('content');
                    return $thumbnailUrl;
                }
            }
        }
        catch(\Exception $e){
            $this->info($e->getMessage());
        }
    }
}
