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
        Commands\DemoCron::class,
    ];
     
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        #$schedule->command('demo:cron')->cron('0 0 15 2,5,8,11 *')->timezone('Asia/Bangkok');
        $schedule->command('demo:cron')->at('16:38')->timezone('Asia/Bangkok');
        //$schedule->command('demo:cron')->cron('58 15 20 2,4,8,11 *')->timezone('Asia/Bangkok');
    }
     
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
     
        require base_path('routes/console.php');
    }
}