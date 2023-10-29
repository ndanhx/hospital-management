<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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

        $user = User::find($heathBook->user_id);
        $listPrescriptions = Prescription::where('heath_book_id',$heathBook->id) ->get();
     
        return view('user.heath_book.heath_book_detail',compact('user','listPrescriptions','heathBook'));

    }
}
