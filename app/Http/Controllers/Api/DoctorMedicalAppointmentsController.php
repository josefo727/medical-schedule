<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalAppointmentResource;
use App\Http\Resources\MedicalAppointmentCollection;

class DoctorMedicalAppointmentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Doctor $doctor)
    {
        $this->authorize('view', $doctor);

        $search = $request->get('search', '');

        $medicalAppointments = $doctor
            ->medicalAppointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new MedicalAppointmentCollection($medicalAppointments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Doctor $doctor)
    {
        $this->authorize('create', MedicalAppointment::class);

        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'date' => ['required', 'date'],
            'status' => ['required', 'in:programado,realizado,cancelado'],
        ]);

        $medicalAppointment = $doctor
            ->medicalAppointments()
            ->create($validated);

        return new MedicalAppointmentResource($medicalAppointment);
    }
}
