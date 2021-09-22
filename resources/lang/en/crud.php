<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'specialties' => [
        'name' => 'Specialties',
        'index_title' => 'Specialties List',
        'new_title' => 'New Specialty',
        'create_title' => 'Create Specialty',
        'edit_title' => 'Edit Specialty',
        'show_title' => 'Show Specialty',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],

    'patients' => [
        'name' => 'Patients',
        'index_title' => 'Patients List',
        'new_title' => 'New Patient',
        'create_title' => 'Create Patient',
        'edit_title' => 'Edit Patient',
        'show_title' => 'Show Patient',
        'inputs' => [
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'email' => 'Email',
            'document_nro' => 'Nro Documento',
            'address' => 'Dirección',
            'phone' => 'Teléfono',
            'gender' => 'Género',
            'birthday' => 'Fecha de Nacimiento',
        ],
    ],

    'medical_appointments' => [
        'name' => 'Medical Appointments',
        'index_title' => 'MedicalAppointments List',
        'new_title' => 'New Medical appointment',
        'create_title' => 'Create MedicalAppointment',
        'edit_title' => 'Edit MedicalAppointment',
        'show_title' => 'Show MedicalAppointment',
        'inputs' => [
            'patient_id' => 'Paciente',
            'doctor_id' => 'Doctor',
            'date' => 'Fecha y Hora',
            'status' => 'Estado',
        ],
    ],

    'reports' => [
        'name' => 'Reports',
        'index_title' => 'Reports List',
        'new_title' => 'New Report',
        'create_title' => 'Create Report',
        'edit_title' => 'Edit Report',
        'show_title' => 'Show Report',
        'inputs' => [
            'record' => 'Antecedentes',
            'evaluation' => 'Evaluación',
            'diagnosis' => 'Diagnóstico',
            'recommendations' => 'Recommendaciones',
            'medical_appointment_id' => 'Medical Appointment',
        ],
    ],

    'doctors' => [
        'name' => 'Doctors',
        'index_title' => 'Listar Doctores',
        'new_title' => 'New Doctor',
        'create_title' => 'Crear Doctor',
        'edit_title' => 'Editar Doctor',
        'show_title' => 'Ver Doctor',
        'inputs' => [
            'specialty_id' => 'Especialidad',
            'document_nro' => 'Nro Documento',
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'email' => 'Email',
            'phone' => 'Teléfono',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
