<?php

namespace App\Console\Commands;

use App\Page;
use Illuminate\Console\Command;
use App\Classes\Page\PageFactory;
use App\Classes\Images\ImageHelper;
use App\Repositories\PageRepository;

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

    protected $url, $id, $pageFactory, $pages;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PageRepository $pages)
    {
        $this->pages = $pages;
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
        $this->id = $this->argument('id');
        $this->pageFactory = PageFactory::create($this->url);

        $thumbnailUrl = $this->pageFactory->getThumbnailUrl();
        if(isset($thumbnailUrl)){
            $path = '/thumbnails/pages/' . $this->id . '.jpg';
            $absolutePath = public_path() . $path;
            ImageHelper::downloadAndResize($thumbnailUrl, $absolutePath, 480, 280);
            $this->pages->updateThumbnailPathById($this->id, $path);
            $this->info('Downloaded image to: ' . $path);
        } else {
            $this->info('$thumbnailUrl is not set');
        }
    }
}
