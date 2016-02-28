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

        // Get thumbnail
        $ytId = $this->urlToVideo($url);
        $thumbnailUrl = 'http://img.youtube.com/vi/' . $ytId . '/0.jpg';

        $fileName = '\\thumbnails\\videos\\' . $id . '.jpg';
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

    protected function urlToVideo($url)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return $match[1];
    }
}
