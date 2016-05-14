<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\Twitter\Message;

class TweetDH extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dh:tweet
    {--queue=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweets communism propaganda';

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
        $this->sendTwitterMessage();
    }

    private function sendTwitterMessage()
    {
        $quotes = config('propaganda.quotes');
        $quote = $quotes[array_rand($quotes)];
        $message = new Message($quote . ' @DragonHackLj', ['DragonHack', 'DragonHackLj', 'Communism']);
        $twitterMessage = $message->compose();
        $this->info($twitterMessage);

        \Twitter::postTweet(['status' => $twitterMessage]);
    }
}
