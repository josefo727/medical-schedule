<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\DoctorCollection;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;

class DoctorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Doctor::class);

        $search = $request->get('search', '');

        $doctors = Doctor::search($search)
            ->latest()
            ->paginate();

        return new DoctorCollection($doctors);
    }

    /**
     * @param \App\Http\Requests\DoctorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorStoreRequest $request)
    {
        $this->authorize('create', Doctor::class);

        $validated = $request->validated();

        $doctor = Doctor::create($validated);

        return new DoctorResource($doctor);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Doctor $doctor)
    {
        $this->authorize('view', $doctor);

        return new DoctorResource($doctor);
    }

    /**
     * @param \App\Http\Requests\DoctorUpdateRequest $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorUpdateRequest $request, Doctor $doctor)
    {
        $this->authorize('update', $doctor);

        $validated = $request->validated();

        $doctor->update($validated);

        return new DoctorResource($doctor);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Doctor $doctor)
    {
        $this->authorize('delete', $doctor);

        $doctor->delete();

        return response()->noContent();
    }
}
