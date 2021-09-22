<?php

namespace App\Http\Controllers\Api;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\DoctorCollection;

class SpecialtyDoctorsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Specialty $specialty)
    {
        $this->authorize('view', $specialty);

        $search = $request->get('search', '');

        $doctors = $specialty
            ->doctors()
            ->search($search)
            ->latest()
            ->paginate();

        return new DoctorCollection($doctors);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Specialty $specialty)
    {
        $this->authorize('create', Doctor::class);

        $validated = $request->validate([
            'document_nro' => ['nullable', 'max:255', 'string'],
            'first_name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'max:255', 'string'],
        ]);

        $doctor = $specialty->doctors()->create($validated);

        return new DoctorResource($doctor);
    }
}
