@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('patients.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.patients.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.first_name')</h5>
                    <span>{{ $patient->first_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.last_name')</h5>
                    <span>{{ $patient->last_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.email')</h5>
                    <span>{{ $patient->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.document_nro')</h5>
                    <span>{{ $patient->document_nro ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.address')</h5>
                    <span>{{ $patient->address ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.phone')</h5>
                    <span>{{ $patient->phone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.gender')</h5>
                    <span>{{ $patient->gender ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.patients.inputs.birthday')</h5>
                    <span>{{ $patient->birthday ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('patients.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Patient::class)
                <a href="{{ route('patients.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
