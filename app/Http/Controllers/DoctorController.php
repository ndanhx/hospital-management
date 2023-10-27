<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Specialty;
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
            $authenticatedDoctor = Auth::guard('doctor')->user();  
            $listSpecialty  = Specialty::all();
            $listAppointment = Appointment::all();
            return view('doctor.appointment.index',compact('listAppointment','listSpecialty'));
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }


    public function appointmentByDoctor(){
        $listAppointment = Appointment::all();
        return view('doctor.appointment.index',compact('listAppointment'));
    }

    
    
    
}
