<?php

return [
    'common' => [
        'actions' => 'Acciones',
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'new' => 'Nuevo',
        'cancel' => 'Cancelar',
        'save' => 'Guardar',
        'delete' => 'Elimiar',
        'delete_selected' => 'Elimiar selected',
        'search' => 'Buscar...',
        'back' => 'Regresar al índice',
        'are_you_sure' => '¿Está seguro?',
        'no_items_found' => 'Sin registros para mostrar',
        'created' => 'Creado satisfactoriamente',
        'saved' => 'Guardado satisfactoriamente',
        'removed' => 'Eliminado satisfactoriamente',
    ],

    'users' => [
        'name' => 'Usuarios',
        'index_title' => 'Lista de Usuarios',
        'new_title' => 'Nuevo Usuario',
        'create_title' => 'Crear Usuario',
        'edit_title' => 'Editar Usuario',
        'show_title' => 'Ver Usuario',
        'inputs' => [
            'name' => 'Nombre',
            'email' => 'Email',
            'password' => 'Contraseña',
        ],
    ],

    'specialties' => [
        'name' => 'Especialidades',
        'index_title' => 'Lista de Especialidades',
        'new_title' => 'Nuevo Especialidad',
        'create_title' => 'Crear Especialidad',
        'edit_title' => 'Editar Especialidad',
        'show_title' => 'Ver Especialidad',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],

    'patients' => [
        'name' => 'Pacientes',
        'index_title' => 'Lista de Pacientes',
        'new_title' => 'Nuevo Paciente',
        'create_title' => 'Crear Paciente',
        'edit_title' => 'Editar Paciente',
        'show_title' => 'Ver Paciente',
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
        'name' => 'Citas',
        'index_title' => 'Lista de Citas',
        'new_title' => 'Nueva Cita',
        'create_title' => 'Crear Cita',
        'edit_title' => 'Editar Cita',
        'show_title' => 'Ver Cita',
        'inputs' => [
            'patient_id' => 'Paciente',
            'doctor_id' => 'Doctor',
            'date' => 'Fecha y Hora',
            'status' => 'Estado',
        ],
    ],

    'reports' => [
        'name' => 'Reportes',
        'index_title' => 'Lista de Reportes',
        'new_title' => 'Nuevo Reporte',
        'create_title' => 'Crear Reporte',
        'edit_title' => 'Editar Reporte',
        'show_title' => 'Ver Reporte',
        'inputs' => [
            'record' => 'Antecedentes',
            'evaluation' => 'Evaluación',
            'diagnosis' => 'Diagnóstico',
            'recommendations' => 'Recommendaciones',
            'medical_appointment_id' => 'Medical Appointment',
        ],
    ],

    'doctors' => [
        'name' => 'Doctores',
        'index_title' => 'Listar Doctores',
        'new_title' => 'Nuevo Doctor',
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
        'create_title' => 'Crear Role',
        'edit_title' => 'Editar Role',
        'show_title' => 'Ver Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Crear Permission',
        'edit_title' => 'Editar Permission',
        'show_title' => 'Ver Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
