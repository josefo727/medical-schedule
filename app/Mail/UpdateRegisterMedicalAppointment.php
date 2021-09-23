<?php

namespace App\Mail;

use App\Models\MedicalAppointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateRegisterMedicalAppointment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var MedicalAppointment
     */
    protected $medicalAppointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MedicalAppointment $medicalAppointment)
    {
        $this->medicalAppointment = $medicalAppointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $medicalAppointment = $this->medicalAppointment;

        return $this->view('mails.notifications-appointment-update', compact('medicalAppointment'))
            ->subject('Su cita');
    }
}
