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

    
    Route::get('/add-doctor', [AdminController::class, 'addview']); 
    Route::post('/upload-doctor', [AdminController::class, 'upload']); 
    Route::get('/edit-doctor/{id}', [AdminController::class, 'editDoctor'])->name('edit-doctor'); 
    Route::patch('/update-doctor/{id}', [AdminController::class, 'update'])->name('update-doctor');
    Route::delete('/delete-doctor/{id}', [AdminController::class, 'deleteDoctor']);
    Route::get('/view-doctor', [AdminController::class, 'index'])->name('view-doctor');


    
    


});


Route::get('/', [HomeController::class, 'index'])->name('home');;

Route::get('/home', [HomeController::class, 'redirect']);

// doctor of admin




    // role doctor


 

 
Route::get('/doctor/login', function () {
    return view('doctor.login');
});
Route::post('/dologin', [DoctorController::class, 'login']);
 


Route::get('/doctor-appointment', [DoctorController::class, 'appointmentByDoctor']);

 

        // Appointment
Route::post('/request-appointment', [AppointmentController::class, 'request']);
Route::get('/view-appointment', [AppointmentController::class, 'viewAppointment']);
Route::post('/update-status-appointment/{id}', [AppointmentController::class,'updateStatus'])->name('update-appointment');
