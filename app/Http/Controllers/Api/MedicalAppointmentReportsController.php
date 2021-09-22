<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MedicalAppointment;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Http\Resources\ReportCollection;

class MedicalAppointmentReportsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalAppointment $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        MedicalAppointment $medicalAppointment
    ) {
        $this->authorize('view', $medicalAppointment);

        $search = $request->get('search', '');

        $reports = $medicalAppointment
            ->reports()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReportCollection($reports);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalAppointment $medicalAppointment
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        MedicalAppointment $medicalAppointment
    ) {
        $this->authorize('create', Report::class);

        $validated = $request->validate([
            'record' => ['required', 'max:255', 'string'],
            'evaluation' => ['required', 'max:255', 'string'],
            'diagnosis' => ['required', 'max:255', 'string'],
            'recommendations' => ['required', 'max:255', 'string'],
        ]);

        $report = $medicalAppointment->reports()->create($validated);

        return new ReportResource($report);
    }
}
