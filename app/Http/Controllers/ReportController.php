<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\MedicalAppointment;
use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;

class ReportController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Report::class);

        $search = $request->get('search', '');

        $reports = Report::search($search)
            ->latest()
            ->paginate(5);

        return view('app.reports.index', compact('reports', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Report::class);

        $medicalAppointments = MedicalAppointment::pluck('id', 'id');

        return view('app.reports.create', compact('medicalAppointments'));
    }

    /**
     * @param \App\Http\Requests\ReportStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportStoreRequest $request)
    {
        $this->authorize('create', Report::class);

        $validated = $request->validated();

        $report = Report::create($validated);

        return redirect()
            ->route('reports.edit', $report)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Report $report)
    {
        $this->authorize('view', $report);

        return view('app.reports.show', compact('report'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Report $report)
    {
        $this->authorize('update', $report);

        $medicalAppointments = MedicalAppointment::pluck('id', 'id');

        return view(
            'app.reports.edit',
            compact('report', 'medicalAppointments')
        );
    }

    /**
     * @param \App\Http\Requests\ReportUpdateRequest $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function update(ReportUpdateRequest $request, Report $report)
    {
        $this->authorize('update', $report);

        $validated = $request->validated();

        $report->update($validated);

        return redirect()
            ->route('reports.edit', $report)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Report $report)
    {
        $this->authorize('delete', $report);

        $report->delete();

        return redirect()
            ->route('reports.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
