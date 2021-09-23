<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\LastAppointmentResource;
use App\Models\MedicalAppointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class LastAppointmentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $documentNro
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response|object
     */
    public function show(string $documentNro)
    {
        // TODO: validar request ajax
//        dd(request()->ajax());
//        if (request()->ajax()) {
//
//        }
         $patientId= optional(Patient::query()
            ->where('document_nro', $documentNro)
            ->first())->id;

         if (is_null($patientId)) {
             // TODO: exception
         }

        $medicalAppointment = MedicalAppointment::query()
            ->where('patient_id', $patientId)
            ->latest('date')
            ->first();

        return new LastAppointmentResource($medicalAppointment);
    }
}
