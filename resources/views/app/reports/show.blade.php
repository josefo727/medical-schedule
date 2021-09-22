@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('reports.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.reports.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.reports.inputs.record')</h5>
                    <span>{{ $report->record ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.reports.inputs.evaluation')</h5>
                    <span>{{ $report->evaluation ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.reports.inputs.diagnosis')</h5>
                    <span>{{ $report->diagnosis ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.reports.inputs.recommendations')</h5>
                    <span>{{ $report->recommendations ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.reports.inputs.medical_appointment_id')</h5>
                    <span
                        >{{ optional($report->medicalAppointment)->id ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('reports.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Report::class)
                <a href="{{ route('reports.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
