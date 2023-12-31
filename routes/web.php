<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HeathBookController;
use App\Http\Controllers\UserController;
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
     
    //USER    
    Route::get('/user-view-appointment', [UserController::class, 'appointmentByUser']);
    Route::get('/user-medical-history', [UserController::class, 'medicalHistoryUser']);
    Route::get('/user-heath-book-detail/{id}', [UserController::class, 'HeathBookDetailUser']); 
    Route::get('/user-view-appointment2', [UserController::class, 'appointmentByUserVIP']); 
});

        //ADMIN

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'  
])->group(function () {
    Route::get('/add-doctor', [AdminController::class, 'addview']); 
    Route::post('/upload-doctor', [AdminController::class, 'upload']); 
    Route::get('/edit-doctor/{id}', [AdminController::class, 'editDoctor'])->name('edit-doctor'); 
    Route::patch('/update-doctor/{id}', [AdminController::class, 'update'])->name('update-doctor');
    Route::delete('/delete-doctor/{id}', [AdminController::class, 'deleteDoctor']);
    Route::get('/view-doctor', [AdminController::class, 'index'])->name('view-doctor');

    
    Route::get('/view-user', [AdminController::class, 'getAllUser'])->name('getAllUser');

    Route::get('/admin-add-user', [AdminController::class, 'addUser'])->name('addUser');
    Route::post('/admin-insert-user', [AdminController::class, 'insertUser'])->name('insertUser');
    Route::delete('/admin-delete-user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');


    
});


Route::get('/', [HomeController::class, 'index'])->name('home');; 
Route::get('/home', [HomeController::class, 'redirect']);
 
 



Route::get('/doctor/login', function () {
    return view('doctor.login');
});
Route::post('/dologin', [DoctorController::class, 'login']); 
Route::get('/doctor-appointment', [DoctorController::class, 'appointmentByDoctor']);
Route::get('/doctor-my-schedule', [DoctorController::class, 'doctorMySchedule']);
Route::get('/doctor-checking-heath_book/{id}', [DoctorController::class, 'createHeathBookByDoctor']);
Route::post('/create-heath-book', [HeathBookController::class, 'createHeathBook']);
Route::get('/doctor-medical-history', [DoctorController::class, 'medicalHistoryDoctor']);
Route::get('/doctor-heath-book-detail/{id}', [DoctorController::class, 'HeathBookDetailDoctor']);
Route::get('/print-pdf/{id}', [DoctorController::class, 'printPDFDoctor']);
Route::get('/doctor-check-records', [DoctorController::class, 'getAllUserCheckRecordsDoctor']);
Route::get('/doctor-search-user', [DoctorController::class, 'searchUserDoctor']);





Route::post('/doctor-search-appointment', [DoctorController::class, 'search']);
Route::post('/doctor-search-date', [DoctorController::class, 'searchDateDoctor']);
Route::post('/doctor-logout', [DoctorController::class, 'logout']);




//select doctor by user vip- ajax
Route::get('/get-doctors-by-specialty/{specialtyId}', [DoctorController::class, 'getDoctorsBySpecialty']);




 


        // Appointment
Route::post('/request-appointment', [AppointmentController::class, 'request']);
Route::get('/view-appointment', [AppointmentController::class, 'viewAppointment']);
Route::post('/update-status-appointment/{id}', [AppointmentController::class,'updateStatus'])->name('update-appointment');
Route::post('/cancel-status-appointment', [AppointmentController::class,'cancelStatus']);

Route::post('/request-appointment-VIP', [AppointmentController::class, 'requestVIP']);