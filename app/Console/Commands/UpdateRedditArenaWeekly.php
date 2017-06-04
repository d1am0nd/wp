<?php

namespace App\Console\Commands;

use App\SiteUpdate;
use Illuminate\Console\Command;

class UpdateRedditArenaWeekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:updateRedditArenaWeekly
    {--queue=default}';

    private $url, $master_url, $json;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if there is new "Top 10 Arena Streamers". Update Twitter accordingly';

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
        // Reddit get api
        // Returns json of last post that has "Top scoring cards of the week from r/CustomHearthstone" in it
        $this->master_url = 'https://www.reddit.com/r/hearthstone/search.json?q=%22Top%2010%20Arena%20Streamers%22&sort=new&limit=1';
        $this->json = $this->getJson();
        $this->url = $this->getLastUrl();
        $identifier = 'top-scoring-arena';
        $subreddit = $this->getSubreddit();

        if($subreddit != 'hearthstone')
            return null;

        $su = SiteUpdate::where('identifier', $identifier)->first();
        if(isset($su)){
            // Update twitter and db record if url is new (different)
            // and new url starts with 'https://tempostorm.com/hearthstone/meta-snapshot/'
            $this->info($this->url);
            if($this->checkIfUrlIsDifferent($su)){
                $this->info('Sending');
                $this->sendTwitterMessage();
            }
        }
        else{
            $su = new SiteUpdate;
            $su->master_url = $this->master_url;
            $su->identifier = $identifier;
        }
        $su->url = $this->url;
        $su->save();
    }

    private function getSubreddit()
    {
        return $this->json->data->children[0]->data->subreddit;
    }

    private function getJson()
    {
        return json_decode(file_get_contents($this->master_url));
    }

    private function getLastUrl()
    {
        // json->data->children->data->url = url of the last post that matched the query
        return $this->json->data->children[0]->data->url;
    }

    private function sendTwitterMessage()
    {
        \Twitter::postTweet(['status' => 'Check out top arena players this week #Hearthstone ' . $this->url, 'format' => 'json']);
    }

    private function checkIfUrlIsDifferent($su)
    {
        if($this->url != $su->url)
            return true;
        return false;
    }
}
