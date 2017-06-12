<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Transformers\CardRepository;

class CheckWikiaUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'urls:wikia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks wikia urls';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CardRepository $repo)
    {
        parent::__construct();
        $this->cards = $repo;
    }

    /** Tests and logs broken wikia links */
    public function handle()
    {
        $false = [];
        foreach ($this->cards->getCardsWithInfo() as $card) {
            $url = $card->wikia_url;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
            curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_TIMEOUT,10);
            $output = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpcode != 200) {
                $this->info($url);
                $this->info($httpcode);
                $false[] = $url;
            }
        }

        \Log::info($false);
        $this->info('false: ' . count($false));

    }
}
