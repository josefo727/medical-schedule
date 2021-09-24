<?php

use App\Models\MedicalAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MedicalAppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
s|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('specialties', SpecialtyController::class);
        Route::resource('patients', PatientController::class);
        Route::resource(
            'medical-appointments',
            MedicalAppointmentController::class
        );
        Route::resource('reports', ReportController::class);
        Route::resource('doctors', DoctorController::class);
    });
Route::get('/test-query', function (){
//    $appointment = MedicalAppointment::query()->with(['patient', 'doctor'])->first();
//    $patient = $appointment->first()->patient;
//    $doctor = $appointment->first()->doctor;
//    return  $patient->fullName . ' ' . $doctor->fullName;

    $appointment = MedicalAppointment::find(1);
    $appointment = DB::table('medical_appointments')
        ->join('patients', 'medical_appointments.patient_id', 'patients.id')
        ->where('medical_appointments.id', 1)
        ->select('patients.first_name')
        ->get();

     return $appointment[0]->first_name;

//    $appointment = MedicalAppointment::query()->first();
//    $patient = $appointment->first()->patient;
//    return  $patient->first_name;
});
