<?php

namespace App\Http\Controllers\Api;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialtyResource;
use App\Http\Resources\SpecialtyCollection;
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
            ->paginate();

        return new SpecialtyCollection($specialties);
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

        return new SpecialtyResource($specialty);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Specialty $specialty)
    {
        $this->authorize('view', $specialty);

        return new SpecialtyResource($specialty);
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

        return new SpecialtyResource($specialty);
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

        return response()->noContent();
    }
}
