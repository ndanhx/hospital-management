<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\HeathBook;
use App\Models\Prescription;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    //
    function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $doctor = Doctor::where('email', $email)->first();
        if ($doctor && Hash::check($password, $doctor->password)) {
            Auth::guard('doctor')->login($doctor);  
           
            return redirect('/doctor-appointment');
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
    

    public function appointmentByDoctor(){
        $authenticatedDoctor = Auth::guard('doctor')->user();  
        $listSpecialty  = Specialty::all();
        $listAppointment  = Appointment::where('status', 'pending')
                                ->orderBy('date_request', 'asc')
                                ->get(); 
    
        return view('doctor.appointment.index',compact('listAppointment','listSpecialty'));
    }
    public function doctorMySchedule(){ 

        $listSpecialty  = Specialty::all();

        $doctorId = Auth::guard('doctor')->user()->id;  
        $listAppointment  = Appointment::where('doctor_id', $doctorId)
                                ->where('status', 'approved')
                                ->orderBy('date_request', 'asc')
                                ->get();
        return view('doctor.appointment.my_schedule',compact('listAppointment','listSpecialty'));
    }
    

    function createHeathBookByDoctor($id){
        $appointment = Appointment::find($id);
        $user = User::find($appointment->user_id); 
        return view('doctor.heath_book.create_heath_book', compact('user','appointment'));
    
    }

    function medicalHistoryDoctor(){
        $doctorId = Auth::guard('doctor')->user()->id;  
        $listMedicalHistory  = HeathBook::where('doctor_id', $doctorId)->get();
        $listUser = User::all();
        return view('doctor.heath_book.medical_history',compact('listMedicalHistory','listUser'));
    }


    function  HeathBookDetailDoctor($id){
        $heathBook  = HeathBook::find($id); 

        $user = User::find($heathBook->user_id);
        $listPrescriptions = Prescription::where('heath_book_id',$heathBook->id) ->get();
     
        return view('doctor.heath_book.heath_book_detail',compact('user','listPrescriptions','heathBook'));
    }

    function search(Request $request){
        $listSpecialty  = Specialty::all();
        $doctorId = Auth::guard('doctor')->user()->id;  

        $name = $request->input('name');
        if($name == ''){
            $listAppointment  = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'approved')
            ->orderBy('date_request', 'asc')
            ->get();
        }else{ 
            $listAppointment  = Appointment::where('doctor_id', $doctorId)
            ->where('name','LIKE', "%$name%")
            ->where('status', 'approved')
            ->orderBy('date_request', 'asc')
            ->get();           
        }       
        return view('doctor.appointment.my_schedule',compact('listAppointment','listSpecialty'));
    }
   

    public function searchDateDoctor(Request $request){
        $listSpecialty = Specialty::all();
        $doctorId = Auth::guard('doctor')->user()->id;
    
        $date = $request->input('date'); 
        $searchDate = Carbon::createFromFormat('Y-m-d', $date)->toDateString(); 
        $listAppointment = Appointment::where('doctor_id', $doctorId)
                                      ->whereDate('date_request', '=', $searchDate)
                                      ->where('status', 'approved')
                                      ->orderBy('date_request', 'asc')
                                      ->get();
    
        return view('doctor.appointment.my_schedule', compact('listAppointment', 'listSpecialty'));
    }
    
    
    
    
    
    

    
    
    
}
