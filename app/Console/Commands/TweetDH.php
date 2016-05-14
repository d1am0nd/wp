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
        $number = rand(0,30);
        if($number==1)
            $this->sendTwitterMessage();
    }

    private function sendTwitterMessage()
    {
        $quotes = config('propaganda.quotes');
        $quote = $quotes[array_rand($quotes)];

        if (!filter_var($quote, FILTER_VALIDATE_URL) === false)
            $message = new Message('', ['DragonHack', 'DragonHackLj'], $quote, 'DragonHackLj');
        else
            $message = new Message($quote, ['DragonHack', 'DragonHackLj'], '', 'DragonHackLj');

        $twitterMessage = $message->compose();
        $this->info($twitterMessage);
        \Twitter::postTweet(['status' => $twitterMessage]);
    }
}
