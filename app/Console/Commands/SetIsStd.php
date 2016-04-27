<?php

namespace App\Console\Commands;

use App\Models\Cards\CardSet;
use Illuminate\Console\Command;

class SetIsStd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:setStandard';

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
        CardSet::whereIn('name', [
                'TGT',
                'LOE',
                'CORE',
                'BRM',
                'EXPERT1',
                'PROMO',
                'REWARD',
                'OG'    
            ])
        ->update([
                'is_standard' => 1
            ]);
    }
}
