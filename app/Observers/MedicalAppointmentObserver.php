<?php

namespace App\Observers;

use App\Jobs\SendMailMedicalAppointmentCreate;
use App\Jobs\SendMailMedicalAppointmentUpdate;
use App\Models\MedicalAppointment;

class MedicalAppointmentObserver
{
    public function created(MedicalAppointment $medicalAppointment)
    {
        SendMailMedicalAppointmentCreate::dispatch($medicalAppointment)
            ->onConnection('database')
            ->onQueue('mails')
            ->delay(now()->addSecond());
    }

    public function updated(MedicalAppointment $medicalAppointment)
    {
        SendMailMedicalAppointmentUpdate::dispatch($medicalAppointment)
            ->onConnection('database')
            ->onQueue('mails')
            ->delay(now()->addSecond());
    }
}
