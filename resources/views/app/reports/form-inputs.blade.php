@php $editing = isset($report) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="record"
            label="Antecedentes"
            maxlength="255"
            required
            >{{ old('record', ($editing ? $report->record : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="evaluation"
            label="Evaluación"
            maxlength="255"
            required
            >{{ old('evaluation', ($editing ? $report->evaluation : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="diagnosis"
            label="Diagnóstico"
            maxlength="255"
            required
            >{{ old('diagnosis', ($editing ? $report->diagnosis : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="recommendations"
            label="Recommendaciones"
            maxlength="255"
            required
            >{{ old('recommendations', ($editing ? $report->recommendations :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="medical_appointment_id"
            label="Medical Appointment"
            required
        >
            @php $selected = old('medical_appointment_id', ($editing ? $report->medical_appointment_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Medical Appointment</option>
            @foreach($medicalAppointments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
