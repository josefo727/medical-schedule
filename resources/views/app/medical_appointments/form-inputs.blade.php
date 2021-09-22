@php $editing = isset($medicalAppointment) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="patient_id" label="Paciente" required>
            @php $selected = old('patient_id', ($editing ? $medicalAppointment->patient_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Patient</option>
            @foreach($patients as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="doctor_id" label="Doctor" required>
            @php $selected = old('doctor_id', ($editing ? $medicalAppointment->doctor_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Doctor</option>
            @foreach($doctors as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.datetime
            name="date"
            label="Fecha y Hora"
            value="{{ old('date', ($editing ? optional($medicalAppointment->date)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="status" label="Estado">
            @php $selected = old('status', ($editing ? $medicalAppointment->status : '')) @endphp
            <option value="programado" {{ $selected == 'programado' ? 'selected' : '' }} >Programado</option>
            <option value="realizado" {{ $selected == 'realizado' ? 'selected' : '' }} >Realizado</option>
            <option value="cancelado" {{ $selected == 'cancelado' ? 'selected' : '' }} >Cancelado</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
