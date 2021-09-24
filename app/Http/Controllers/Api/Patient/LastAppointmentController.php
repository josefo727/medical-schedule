<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\LastAppointmentResource;
use App\Models\MedicalAppointment;
use App\Models\Patient;
use App\Traits\ApiResponse;

class LastAppointmentController extends Controller
{
    use ApiResponse;
    /**
     * Display the specified resource.
     *
     * @param string $documentNro
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response|object
     */
    public function show(string $documentNro)
    {
        $patientId= Patient::findIdPatientFromDocumentNumber($documentNro);

         if (is_null($patientId)) {
             return $this->errorResponse('Paciente no encontrado.', 406);
         }

        $medicalAppointment = MedicalAppointment::query()
            ->where('patient_id', $patientId)
            ->latest('date')
            ->first();

        if (is_null($medicalAppointment)) {
            return $this->errorResponse('El paciente no tiene citas registradas.', 406);
        }

         $lastAppointment = new LastAppointmentResource($medicalAppointment);

         return $this->successResponse($lastAppointment);
    }
}
