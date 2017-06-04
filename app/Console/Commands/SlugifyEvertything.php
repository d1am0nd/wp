<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SlugifyEvertything extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slugify:everything';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Goes through all pages and videos and assigns them slug based on title';

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
        $videos = \App\Video::get();
        $pages = \App\Page::get();

        foreach($videos as $video){
            $video->slug = str_slug($video->title);
            $video->save();
        }

        foreach($pages as $page){
            $page->slug = str_slug($page->title);
            $page->save();
        }

        $this->info('Done');
    }
}
