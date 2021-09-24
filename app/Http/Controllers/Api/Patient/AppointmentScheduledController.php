<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentScheduledCollection;
use App\Models\MedicalAppointment;
use App\Models\Patient;
use App\Traits\ApiResponse;

class AppointmentScheduledController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(string $documentNro)
    {
        $patientId= Patient::findIdPatientFromDocumentNumber($documentNro);

        if (is_null($patientId)) {
            return $this->errorResponse('Paciente no encontrado.', 406);
        }

        $medicalAppointment = MedicalAppointment::query()
            ->with(['doctor', 'doctor.specialty'])
            ->where('patient_id', $patientId)
            ->whereStatus( 'programado')
            ->latest('date')
            ->get();

        if ($medicalAppointment->count() === 0) {
            return $this->errorResponse('El paciente no tiene citas registradas.', 406);
        }

        $data = new AppointmentScheduledCollection($medicalAppointment);

        return $this->successResponse($data);
    }

}
