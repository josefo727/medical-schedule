<?php

use App\Http\Controllers\Api\Patient\LastAppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\SpecialtyDoctorsController;
use App\Http\Controllers\Api\MedicalAppointmentController;
use App\Http\Controllers\Api\MedicalAppointmentReportsController;
use App\Http\Controllers\Api\DoctorMedicalAppointmentsController;
use App\Http\Controllers\Api\PatientMedicalAppointmentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('specialties', SpecialtyController::class);

        // Specialty Doctors
        Route::get('/specialties/{specialty}/doctors', [
            SpecialtyDoctorsController::class,
            'index',
        ])->name('specialties.doctors.index');
        Route::post('/specialties/{specialty}/doctors', [
            SpecialtyDoctorsController::class,
            'store',
        ])->name('specialties.doctors.store');

        Route::apiResource('patients', PatientController::class);

        // Patient Medical Appointments
        Route::get('/patients/{patient}/medical-appointments', [
            PatientMedicalAppointmentsController::class,
            'index',
        ])->name('patients.medical-appointments.index');
        Route::post('/patients/{patient}/medical-appointments', [
            PatientMedicalAppointmentsController::class,
            'store',
        ])->name('patients.medical-appointments.store');

        Route::apiResource(
            'medical-appointments',
            MedicalAppointmentController::class
        );

        // MedicalAppointment Reports
        Route::get('/medical-appointments/{medicalAppointment}/reports', [
            MedicalAppointmentReportsController::class,
            'index',
        ])->name('medical-appointments.reports.index');
        Route::post('/medical-appointments/{medicalAppointment}/reports', [
            MedicalAppointmentReportsController::class,
            'store',
        ])->name('medical-appointments.reports.store');

        Route::apiResource('reports', ReportController::class);

        Route::apiResource('doctors', DoctorController::class);

        // Doctor Medical Appointments
        Route::get('/doctors/{doctor}/medical-appointments', [
            DoctorMedicalAppointmentsController::class,
            'index',
        ])->name('doctors.medical-appointments.index');
        Route::post('/doctors/{doctor}/medical-appointments', [
            DoctorMedicalAppointmentsController::class,
            'store',
        ])->name('doctors.medical-appointments.store');
    });

Route::name('api.patient.')
    ->group(function (){
        Route::get('/last-appointment/{documentNro}', [LastAppointmentController::class, 'show']);
    });
