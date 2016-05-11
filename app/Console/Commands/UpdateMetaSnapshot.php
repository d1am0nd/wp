<?php

namespace App\Console\Commands;

use App\SiteUpdate;
use Illuminate\Console\Command;
use App\Classes\Twitter\Message;

class UpdateMetaSnapshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snapshot:updateUrl
    {--queue=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates Twitter account if new snapshot is out';

    private $url, $master_url;
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
        $this->master_url = 'https://tempostorm.com/hearthstone/meta-snapshot/standard';
        $this->url = $this->getLastUrl();

        $identifier = 'tempostorm-meta-snapshot';
        $su = SiteUpdate::where('identifier', $identifier)->first();
        $this->info($su->url);
        if(isset($su)){
            // Update twitter and db record if url is new (different)
            // and new url starts with 'https://tempostorm.com/hearthstone/meta-snapshot/'
            $this->info($this->url);
            if($this->checkIfUrlIsDifferent($su) && starts_with($this->url, $su->master_url . '/')){
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
        $api = 'https://tempostorm.com/api/snapshots/findOne?filter=%7B%22order%22:%22createdDate+DESC%22,%22fields%22:%5B%22id%22,%22snapshotType%22%5D,%22where%22:%7B%22isActive%22:true,%22snapshotType%22:%22standard%22%7D,%22include%22:%5B%7B%22relation%22:%22slugs%22%7D%5D%7D';
        $json = json_decode(file_get_contents($api));
        // $json->slugs[0]->slug = 'meta-snapshot-1-the-new-standard'
        // full url = 'https://tempostorm.com/hearthstone/meta-snapshot/standard/meta-snapshot-1-the-new-standard'
        $url = $this->master_url . '/' . $json->slugs[0]->slug;
        $this->info($url);
        return $url;

        /*
        // Old implementation
        $url = \File(base_path() . '/phantomjs2/snapshotUrl.txt');
        return $url[0];
        */
    }

    private function checkIfUrlIsDifferent($su)
    {
        if($this->url != $su->url)
            return true;
        return false;
    }

    private function sendTwitterMessage()
    {
        $message = new Message('New TempoStorm standard meta snapshot is out!', ['hearthstone', 'tempostorm'], $this->url);
        $twitterMessage = $message->compose();
        $this->info($twitterMessage);
        \Twitter::postTweet(['status' => $twitterMessage]);
    }

    private function startsWith($haystack, $needle){
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
