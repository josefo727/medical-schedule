@php $editing = isset($patient) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="first_name"
            label="Nombre"
            value="{{ old('first_name', ($editing ? $patient->first_name : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="last_name"
            label="Apellido"
            value="{{ old('last_name', ($editing ? $patient->last_name : '')) }}"
            maxlength="255"
            placeholder="Apellido"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $patient->email : '')) }}"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="document_nro"
            label="Nro Documento"
            value="{{ old('document_nro', ($editing ? $patient->document_nro : '')) }}"
            maxlength="255"
            placeholder="Nro Documento"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="address"
            label="Dirección"
            value="{{ old('address', ($editing ? $patient->address : '')) }}"
            maxlength="255"
            placeholder="Dirección"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.text
            name="phone"
            label="Teléfono"
            value="{{ old('phone', ($editing ? $patient->phone : '')) }}"
            maxlength="255"
            placeholder="Teléfono"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="gender" label="Género">
            @php $selected = old('gender', ($editing ? $patient->gender : '')) @endphp
            <option value="hombre" {{ $selected == 'hombre' ? 'selected' : '' }} >Hombre</option>
            <option value="mujer" {{ $selected == 'mujer' ? 'selected' : '' }} >Mujer</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.date
            name="birthday"
            label="Fecha de Nacimiento"
            value="{{ old('birthday', ($editing ? optional($patient->birthday)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
