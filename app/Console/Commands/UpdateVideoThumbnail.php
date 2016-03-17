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
    {url : URL of the new video}';

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
        $id = $this->argument('id');
        $url = $this->argument('url');

        $thumbnailUrl = $this->channelThumbnailUrl($url);
        $this->line($thumbnailUrl);
        
        $fileName = '/thumbnails/videos/' . $id . '.jpg';
        $absolutePath = public_path() . $fileName;

        // Save thumbnail to public/thumbnails
        file_put_contents($absolutePath, file_get_contents($thumbnailUrl));

        // Gets publishedAt attribute with Youtube API
        $video = new Youtube();
        $result = $video->getVideoInfo($ytId);
        $publishedAt = $result->snippet->publishedAt;
        $publishedAt = \Carbon\Carbon::parse($publishedAt);

        Video::where('id', $id)->update(['thumbnail_path' => $fileName, 'published_at' => $publishedAt]);
    }

    protected function videoThumbnailUrl($url)
    {
        // Get thumbnail url from video
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $ytId = $match[1];
        $thumbnailUrl = 'http://img.youtube.com/vi/' . $ytId . '/0.jpg';
        return $thumbnailUrl;
    }

    protected function channelThumbnailUrl($url)
    {
        try{
            // Get og tags from url
            libxml_use_internal_errors(true);
            $doc = new \DomDocument();

            if(!env('VERIFY_SSL')){
                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );  
            }

            $doc->loadHTML(file_get_contents($url, false, stream_context_create($arrContextOptions)));

            $xpath = new \DOMXPath($doc);
            $query = '//img[@class="appbar-nav-avatar"]';
            $metas = $xpath->query($query);


            foreach ($metas as $meta) {
                $this->info('1');
                $property = $meta->getAttribute('class');
                if($property == "appbar-nav-avatar"){
                    // TODO
                    $thumbnailUrl = $meta->getAttribute('src');
                    
                    /*
                    $fileName = '\\thumbnails\\pages\\' . $id . '.jpg';
                    $absolutePath = public_path() . $fileName;
                    // Save thumbnail to public/thumbnails/pages
                    $img = \Image::make($thumbnailUrl)->fit(480, 280);
                    $img->save($absolutePath);

                    Page::where('id', $id)->update(['thumbnail_path' => $fileName]);
                    break;
                    */
                    return $thumbnailUrl;
                }
            }
        }
        catch(\Exception $e){
            $this->info($e->getMessage());
        }
    }
}
