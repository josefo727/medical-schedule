<?php

namespace App\Console\Commands;

use App\Models\MedicalAppointment;
use Illuminate\Console\Command;

class CancelAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para cancelar citas no asistidas.';

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
     * @return int
     */
    public function handle()
    {
        MedicalAppointment::query()
            ->where('date', '<', now())
            ->whereStatus('programado')
            ->update([
                'status' => 'cancelado'
            ]);

        return 0;
    }
}
