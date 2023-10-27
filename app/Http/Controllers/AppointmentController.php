<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    //
    function request(Request $request){
        $request->validate([
            'date' => 'required|date',
            'specialty_id' => 'required|exists:specialties,id',  
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        $appointment = new Appointment;
        $appointment->user_id = Auth::id();  
        $appointment->name = Auth::user()->name;
        $appointment->email = Auth::user()->email;
        $appointment->date_request = $request->input('date');
        $appointment->specialty_id = $request->input('specialty_id');
        $appointment->phone = $request->input('phone');
        $appointment->message = $request->input('message');
        $appointment->status =  'pending';
        $appointment->save();
        return redirect('');

    }

    
}
