<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class IsVideoEverything extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:IsVideoEverything';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        foreach($videos as $video){
            \Artisan::queue('video:updateThumbnail', [
                'id' => $video->id, 'url' => $video->url
            ]);
            $this->line('Video id ' . $video->id . ' is done.');
        }
        $this->line('Done');
    }
}
