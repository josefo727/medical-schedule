@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('medical-appointments.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.medical_appointments.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>
                        @lang('crud.medical_appointments.inputs.patient_id')
                    </h5>
                    <span
                        >{{ optional($medicalAppointment->patient)->document_nro
                        ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_appointments.inputs.doctor_id')</h5>
                    <span
                        >{{ optional($medicalAppointment->doctor)->document_nro
                        ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_appointments.inputs.date')</h5>
                    <span>{{ $medicalAppointment->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.medical_appointments.inputs.status')</h5>
                    <span>{{ $medicalAppointment->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('medical-appointments.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\MedicalAppointment::class)
                <a
                    href="{{ route('medical-appointments.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
