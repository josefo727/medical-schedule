<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MedicalAppointment;
use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalAppointmentResource;
use App\Http\Resources\MedicalAppointmentCollection;
use App\Http\Requests\MedicalAppointmentStoreRequest;
use App\Http\Requests\MedicalAppointmentUpdateRequest;

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
            ->paginate();

        return new MedicalAppointmentCollection($medicalAppointments);
    }

    /**
     * @param \App\Http\Requests\MedicalAppointmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalAppointmentStoreRequest $request)
    {
        $this->authorize('create', MedicalAppointment::class);

        $validated = $request->validated();

        $medicalAppointment = MedicalAppointment::create($validated);

        return new MedicalAppointmentResource($medicalAppointment);
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

        return new MedicalAppointmentResource($medicalAppointment);
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

        return new MedicalAppointmentResource($medicalAppointment);
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

        return response()->noContent();
    }
}
