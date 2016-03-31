<?php

namespace App\Console\Commands;

use App\Page;
use Illuminate\Console\Command;

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
        try{
            // Get og tags from url
            libxml_use_internal_errors(true);
            $doc = new \DomDocument();
            $doc->loadHTML(file_get_contents($url));
            $xpath = new \DOMXPath($doc);
            $query = '//*/meta[starts-with(@property, \'og:image\')]';
            $metas = $xpath->query($query);

            foreach ($metas as $meta) {
                $property = $meta->getAttribute('property');
                if($property == "og:image"){
                    $thumbnailUrl = $meta->getAttribute('content');
                    if(!$this->startsWith($thumbnailUrl, 'http://') || $this->startsWith($thumbnailUrl, 'https://'))
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

                    Page::where('id', $id)->update(['thumbnail_path' => $fileName]);
                    break;
                }
            }
        }
        catch(\Exception $e){
            $this->info($e->getMessage());
        }
    }

    private function startsWith($haystack, $needle){
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
