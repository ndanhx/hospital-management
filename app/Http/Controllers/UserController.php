<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\HeathBook;
use App\Models\Prescription;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    
    public function appointmentByUser(){


        $today = now()->toDateString();
        $appointmentsToUpdate = Appointment::where('status', 'pending')
                                    ->where('date_request', '<', $today)
                                    ->get();
    
        foreach ($appointmentsToUpdate as $appointment) {
            $appointment->status = 'cancel';  
            $appointment->save();
        }

        $user_id = Auth::user()->id;  
        


        $listSpecialty  = Specialty::all();
        $listAppointment  = Appointment::where('user_id',$user_id )
                                ->orderBy('date_request', 'desc')
                                ->get(); 
    
        return view('user.appointment.appointment',compact('listAppointment','listSpecialty'));
    }

    function medicalHistoryUser(){
        $user_id = Auth::user()->id;  
        $listMedicalHistory  = HeathBook::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->get();
        $listUser = User::all();
        return view('user.heath_book.medical_history',compact('listMedicalHistory','listUser'));
    }


    function HeathBookDetailUser($id){
        $heathBook  = HeathBook::find($id); 
        $doctor = Doctor::where('id',$heathBook->doctor_id)->get();

        $user = User::find($heathBook->user_id);
        $listPrescriptions = Prescription::where('heath_book_id',$heathBook->id) ->get();
     
        return view('user.heath_book.heath_book_detail',compact('user','listPrescriptions','heathBook','doctor'));

    }

    function  appointmentByUserVIP(Request $request){
        $appointment = new Appointment;
        $appointment->user_id = Auth::id();  
        $appointment->name = Auth::user()->name;
        $appointment->email = Auth::user()->email;
        $appointment->date_request = $request->input('date_request');
        $appointment->specialty_id = $request->input('specialty_id');
        $appointment->phone = $request->input('phone');
        $appointment->message = $request->input('message');
        $appointment->VIP = 1;
        $appointment->status =  'approved';
        $appointment->doctor_id =   $request->input('doctor_id');
        $appointment->save(); 
        return redirect('user-view-appointment')->with('message', 'You have successfully made a payment of 100,000 VND, and your appointment booking has been accepted'); 

    }



   
}
