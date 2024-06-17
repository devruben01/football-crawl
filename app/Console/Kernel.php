<?php

namespace App\Console;

use App\Constants\Constants;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('crawl:xoso-live', [
        //     '--type' => 'mien-bac'
        // ])->dailyAt('18:05')->between('18:05', '18:50')->everyTenSeconds();

        // $schedule->command('crawl:xoso-live', [
        //     '--type' => 'mien-trung'
        // ])->dailyAt('17:05')->between('17:05', '17:50')->everyTenSeconds();

        // $schedule->command('crawl:xoso-live', [
        //     '--type' => 'mien-nam'
        // ])->dailyAt('16:05')->between('16:05', '16:50')->everyTenSeconds();

        // $schedule->command('crawl:xoso-live', [
        //     '--type' => 'vietlott',
        //     '--stake' => 'power-6x55',
        // ])
        //     ->days(Constants::VIETLOTT['power-6x55']['drawing_day'])
        //     ->dailyAt('18:05')
        //     ->between('18:05', '18:50')
        //     ->everyTenSeconds();

        // $schedule->command('crawl:xoso-live', [
        //     '--type' => 'vietlott',
        //     '--stake' => 'mega-6x45',
        // ])
        //     ->days(Constants::VIETLOTT['mega-6x45']['drawing_day'])
        //     ->dailyAt('18:05')
        //     ->between('18:05', '18:50')
        //     ->everyTenSeconds();

        // $schedule->command('crawl:xoso-live', [
        //     '--type' => 'vietlott',
        //     '--stake' => 'max-3d',
        // ])
        //     ->days(Constants::VIETLOTT['max-3d']['drawing_day'])
        //     ->dailyAt('18:00')
        //     ->between('18:00', '19:30')
        //     ->everyTenSeconds();

        // $schedule->command('crawl:xoso-live', [
        //     '--type' => 'vietlott',
        //     '--stake' => 'max-3d-pro',
        // ])
        //     ->days(Constants::VIETLOTT['max-3d-pro']['drawing_day'])
        //     ->dailyAt('18:00')
        //     ->between('18:00', '19:30')
        //     ->everyTenSeconds();


        $schedule->command('app:retry-failed-jobs')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
