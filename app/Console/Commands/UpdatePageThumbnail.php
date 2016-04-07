<?php

namespace App\Console\Commands;

use App\Page;
use Illuminate\Console\Command;
use App\Classes\Parsers\HtmlParser;

class UpdatePageThumbnail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:updateThumbnail {id : Id of the page database record} 
    {url : URL of the new page}
    {--queue=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates page thumbnail';

    protected $url;

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
        $id = $this->argument('id');

        $thumbnailUrl = $this->pageThumbnailUrl();
        if(!starts_with($thumbnailUrl, 'http://') || starts_with($thumbnailUrl, 'https://'))
            $thumbnailUrl = 'http://' . $thumbnailUrl;

        $fileName = '/thumbnails/pages/' . $id . '.jpg';
        $absolutePath = public_path() . $fileName;
        try{
            // Save thumbnail to public/thumbnails/pages
            $img = \Image::make($thumbnailUrl)->fit(480, 280);
            $img->save($absolutePath);
        }catch(Exception $e){
            break;
        }
        catch(\Exception $e){
            $this->info($e->getMessage());
        }
        Page::where('id', $id)->update(['thumbnail_path' => $fileName]);
    }

    private function pageThumbnailUrl()
    {
        $htmlParser = new HtmlParser($this->url);
        return $htmlParser->getDomAttVal('meta', 'property', 'og:image', 'content');
    }
}
