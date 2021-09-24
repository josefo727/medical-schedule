<?php

namespace App\Jobs;

use App\Mail\NewRegisterMedicalAppointment;
use App\Models\MedicalAppointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailMedicalAppointmentCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var MedicalAppointment
     */
    protected $medicalAppointment;

    protected $emails = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MedicalAppointment $medicalAppointment)
    {
        $this->medicalAppointment = $medicalAppointment;
        $this->emails[] = $this->medicalAppointment->doctor->email;
        $this->emails[] = $this->medicalAppointment->patient->email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->emails)
            ->send(new NewRegisterMedicalAppointment($this->medicalAppointment));
    }
}
