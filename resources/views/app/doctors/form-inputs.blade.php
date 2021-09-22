@php $editing = isset($doctor) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="specialty_id" label="Especialidad" required>
            @php $selected = old('specialty_id', ($editing ? $doctor->specialty_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Specialty</option>
            @foreach($specialties as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="document_nro"
            label="Nro Documento"
            value="{{ old('document_nro', ($editing ? $doctor->document_nro : '')) }}"
            maxlength="255"
            placeholder="Nro Documento"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="first_name"
            label="Nombre"
            value="{{ old('first_name', ($editing ? $doctor->first_name : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="last_name"
            label="Apellido"
            value="{{ old('last_name', ($editing ? $doctor->last_name : '')) }}"
            maxlength="255"
            placeholder="Apellido"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $doctor->email : '')) }}"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="phone"
            label="Teléfono"
            value="{{ old('phone', ($editing ? $doctor->phone : '')) }}"
            maxlength="255"
            placeholder="Phone"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
