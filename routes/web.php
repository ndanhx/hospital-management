<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Models\Appointment;
use App\Models\Doctor;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect']);

Route::get('/add-doctor', [AdminController::class, 'addview']);

Route::post('/upload-doctor', [AdminController::class, 'upload']);



Route::get('/doctor', [AdminController::class, 'index']);

Route::get('/doctor/appointment', [DoctorController::class, 'routeDoctor']);

 
Route::get('/doctor/login', function () {
    return view('doctor.login');
});
Route::post('/dologin', [DoctorController::class, 'login']);


Route::get('/doctor/appointment', [DoctorController::class, 'appointmentByDoctor']);





Route::post('/request-appointment', [AppointmentController::class, 'request']);
 


