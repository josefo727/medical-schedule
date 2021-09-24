<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\MedicalAppointment;
use App\Http\Requests\MedicalAppointmentStoreRequest;
use App\Http\Requests\MedicalAppointmentUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MedicalAppointmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', MedicalAppointment::class);

        $search = $request->get('search', '');

        $medicalAppointments = MedicalAppointment::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.medical_appointments.index',
            compact('medicalAppointments', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', MedicalAppointment::class);

        $patients = Patient::select('first_name', 'last_name', 'id')->get();
        $doctors = Doctor::select('first_name', 'last_name', 'id')->get();

        return view(
            'app.medical_appointments.create',
            compact('patients', 'doctors')
        );
    }

    /**
     * @param \App\Http\Requests\MedicalAppointmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalAppointmentStoreRequest $request)
    {
        $this->authorize('create', MedicalAppointment::class);

        $validated = $request->validated();

        try {
            DB::beginTransaction();
                $medicalAppointment = MedicalAppointment::create($validated);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()
            ->route('medical-appointments.edit', $medicalAppointment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalAppointment $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(
        Request $request,
        MedicalAppointment $medicalAppointment
    ) {
        $this->authorize('view', $medicalAppointment);

        return view(
            'app.medical_appointments.show',
            compact('medicalAppointment')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalAppointment $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        MedicalAppointment $medicalAppointment
    ) {
        $this->authorize('update', $medicalAppointment);

        $patients = Patient::select('first_name', 'last_name', 'id')->get();
        $doctors = Doctor::select('first_name', 'last_name', 'id')->get();

        return view(
            'app.medical_appointments.edit',
            compact('medicalAppointment', 'patients', 'doctors')
        );
    }

    /**
     * @param \App\Http\Requests\MedicalAppointmentUpdateRequest $request
     * @param \App\Models\MedicalAppointment $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(
        MedicalAppointmentUpdateRequest $request,
        MedicalAppointment $medicalAppointment
    ) {
        $this->authorize('update', $medicalAppointment);

        $validated = $request->validated();

        $medicalAppointment->update($validated);

        return redirect()
            ->route('medical-appointments.edit', $medicalAppointment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalAppointment $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Request $request,
        MedicalAppointment $medicalAppointment
    ) {
        $this->authorize('delete', $medicalAppointment);

        $medicalAppointment->delete();

        return redirect()
            ->route('medical-appointments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
