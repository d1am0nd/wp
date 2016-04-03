<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\UpdateVideoThumbnail::class,
        Commands\UpdatePageThumbnail::class,
        Commands\UpdateMetaSnapshot::class,
        Commands\UpdateRedditCustomWeekly::class,
        Commands\UpdateRedditArenaWeekly::class,
        Commands\SlugifyEvertything::class,
        Commands\IsVideoEverything::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('twitter:updateRedditCustomWeekly')
                 ->everyThirtyMinutes();
        $schedule->command('twitter:updateRedditArenaWeekly')
                 ->everyThirtyMinutes();
        $schedule->command('snapshot:updateUrl')
                 ->everyThirtyMinutes();
    }
}
