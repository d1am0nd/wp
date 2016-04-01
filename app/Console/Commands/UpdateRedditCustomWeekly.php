<?php

namespace App\Console\Commands;

use App\SiteUpdate;
use Illuminate\Console\Command;

class UpdateRedditCustomWeekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:updateRedditCustomWeekly
    {--queue=default}';

    private $url, $master_url;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if there is new "Top 5 cards of the week from r/CustomHearthstone". Update Twitter accordingly';

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
        $this->master_url = 'https://www.reddit.com/r/hearthstone/search.json?q=Top%205%20Scoring%20Cards%20of%20the%20Week%20from%20r/CustomHearthstone&sort=new&limit=1';
        $this->url = $this->getLastUrl();
        $identifier = 'top-scoring-custom';

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

    private function getLastUrl()
    {
        $query = $this->master_url;
        $json = json_decode(file_get_contents($query));
        // json->data->children->data->url = url of the last post that matched the query
        $url = $json->data->children[0]->data->url;
        return $url;
    }

    private function sendTwitterMessage()
    {
        \Twitter::postTweet(['status' => 'Cool new cards from r/CustomHearthstone ' . $this->url, 'format' => 'json']);
    }

    private function checkIfUrlIsDifferent($su)
    {
        if($this->url != $su->url)
            return true;
        return false;
    }
}
