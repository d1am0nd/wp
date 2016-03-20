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
        $this->url = $this->getLastMetaSnapshotUrl();
        $identifier = 'tempostorm-meta-snapshot';
        $su = SiteUpdate::where('identifier', $identifier)->first();
        if(isset($su)){
            // Update twitter and db record if url is new (different)
            // and new url starts with 'https://tempostorm.com/hearthstone/meta-snapshot/'
            $this->info($this->url);
            if($this->checkIfUrlIsDifferent($su) && $this->startsWith($this->url, $su->master_url . '/')){
                $this->url('Sending');
                $this->sendTwitterMessage();
                $su->url = $this->url;
            }
        }
        else{
            $su = new SiteUpdate;
            $su->master_url = 'https://tempostorm.com/hearthstone/meta-snapshot';
            $su->url = $this->url;
            $su->identifier = $this->identifier;
        }
        $su->save();

    }

    private function getLastMetaSnapshotUrl()
    {
        $url = \File(base_path() . '/phantomjs2/snapshotUrl.txt');
        return $url[0];
    }

    private function checkIfUrlIsDifferent($su)
    {
        if($this->url != $su->url)
            return true;
        return false;
    }

    private function sendTwitterMessage()
    {
        \Twitter::postTweet(['status' => 'New Tempostorm meta snapshot is out! @Tempo_Storm', 'format' => 'json']);
    }

    private function startsWith($haystack, $needle){
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
