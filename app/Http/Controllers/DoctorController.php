<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view('app.doctors.index', compact('doctors', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Doctor::class);

        $specialties = Specialty::pluck('name', 'id');

        return view('app.doctors.create', compact('specialties'));
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

        return redirect()
            ->route('doctors.edit', $doctor)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Doctor $doctor)
    {
        $this->authorize('view', $doctor);

        return view('app.doctors.show', compact('doctor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Doctor $doctor)
    {
        $this->authorize('update', $doctor);

        $specialties = Specialty::pluck('name', 'id');

        return view('app.doctors.edit', compact('doctor', 'specialties'));
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

        return redirect()
            ->route('doctors.edit', $doctor)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('doctors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
