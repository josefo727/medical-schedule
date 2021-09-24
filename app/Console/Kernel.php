<?php

namespace App\Console;

use App\Console\Commands\CancelAppointments;
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
        CancelAppointments::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('cancel:appointments')->daily();
        $schedule->command('cancel:appointments')
            ->timezone('America/Bogota')
            ->dailyAt('17:57');
        // ->cron('0 */6 * * *') 00, 06, 12, 18 Horas
        // ->everySixHours() 00, 06, 12, 18 Horas
        // ->everyFifteenMinutes() 00, 15, 30, 45 Minutos

        // En consola para las tareas programadas
        // php artisan schedule:work

        // En consola para los trabajos encolados
        // php artisan queue:work --queue=mails
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
