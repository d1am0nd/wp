<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class FetchNewJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'json:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches new cards json from https://api.hearthstonejson.com/v1/19506/all/cards.collectible.json';

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
        $json = file_get_contents('https://api.hearthstonejson.com/v1/19506/all/cards.collectible.json');

        File::put(storage_path('cards.json'), $json);
    }
}
