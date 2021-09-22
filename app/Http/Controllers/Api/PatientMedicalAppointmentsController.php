<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalAppointmentResource;
use App\Http\Resources\MedicalAppointmentCollection;

class PatientMedicalAppointmentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Patient $patient)
    {
        $this->authorize('view', $patient);

        $search = $request->get('search', '');

        $medicalAppointments = $patient
            ->medicalAppointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new MedicalAppointmentCollection($medicalAppointments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        $this->authorize('create', MedicalAppointment::class);

        $validated = $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'date' => ['required', 'date'],
            'status' => ['required', 'in:programado,realizado,cancelado'],
        ]);

        $medicalAppointment = $patient
            ->medicalAppointments()
            ->create($validated);

        return new MedicalAppointmentResource($medicalAppointment);
    }
}
