<?php

namespace App\Console\Commands;

use App\SiteUpdate;
use Illuminate\Console\Command;

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

    private $url;
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
        $this->master_url = 'https://tempostorm.com/hearthstone/meta-snapshot';
        $this->url = $this->getLastMetaSnapshotUrl();

        $identifier = 'tempostorm-meta-snapshot';
        $su = SiteUpdate::where('identifier', $identifier)->first();
        if(isset($su)){
            // Update twitter and db record if url is new (different)
            // and new url starts with 'https://tempostorm.com/hearthstone/meta-snapshot/'
            $this->info($this->url);
            if($this->checkIfUrlIsDifferent($su) && $this->startsWith($this->url, $su->master_url . '/')){
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

    private function getLastMetaSnapshotUrl()
    {
        $api = 'https://tempostorm.com/api/snapshots/findOne?filter=%7B%22order%22:%22createdDate+DESC%22,%22where%22:%7B%22isActive%22:true%7D%7D';
        $json = json_decode(file_get_contents($api));
        // $json->slug->url = 'the-old-standard'
        // full url = 'https://tempostorm.com/hearthstone/meta-snapshot/the-old-standard'
        $url = $this->master_url . '/' . $json->slug->url;
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
        \Twitter::postTweet(['status' => 'New Tempostorm meta snapshot is out! ' . $this->url . ' @Tempo_Storm', 'format' => 'json']);
    }

    private function startsWith($haystack, $needle){
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
