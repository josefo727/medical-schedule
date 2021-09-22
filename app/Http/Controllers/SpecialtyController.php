<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Requests\SpecialtyStoreRequest;
use App\Http\Requests\SpecialtyUpdateRequest;

class SpecialtyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Specialty::class);

        $search = $request->get('search', '');

        $specialties = Specialty::search($search)
            ->latest()
            ->paginate(5);

        return view('app.specialties.index', compact('specialties', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Specialty::class);

        return view('app.specialties.create');
    }

    /**
     * @param \App\Http\Requests\SpecialtyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialtyStoreRequest $request)
    {
        $this->authorize('create', Specialty::class);

        $validated = $request->validated();

        $specialty = Specialty::create($validated);

        return redirect()
            ->route('specialties.edit', $specialty)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Specialty $specialty)
    {
        $this->authorize('view', $specialty);

        return view('app.specialties.show', compact('specialty'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Specialty $specialty)
    {
        $this->authorize('update', $specialty);

        return view('app.specialties.edit', compact('specialty'));
    }

    /**
     * @param \App\Http\Requests\SpecialtyUpdateRequest $request
     * @param \App\Models\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(
        SpecialtyUpdateRequest $request,
        Specialty $specialty
    ) {
        $this->authorize('update', $specialty);

        $validated = $request->validated();

        $specialty->update($validated);

        return redirect()
            ->route('specialties.edit', $specialty)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Specialty $specialty)
    {
        $this->authorize('delete', $specialty);

        $specialty->delete();

        return redirect()
            ->route('specialties.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
