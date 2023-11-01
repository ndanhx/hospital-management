<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\HeathBook;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeathBookController extends Controller
{
    //
    function createHeathBook(Request $request){

        $diagnosis = $request->input('diagnosis');
        $user_id = $request->input('userID'); 
        $doctor_id =  Auth::guard('doctor')->user()->id;  

        $appointment_id =  $request->input('appointment_id'); 
        $appointment = Appointment::find($appointment_id);
        $appointment->status = 'completed'; 
        $appointment->save();

        $idHeathBook = HeathBook::create([
            'user_id' => $user_id,
            'doctor_id' => $doctor_id,
            'diagnosis' => $diagnosis,
        ])->id;

        $drugNames = $request->input('Drug_name');
        $quantities = $request->input('soluong');
        $times = $request->input('time');

        for ($i = 0; $i < count($drugNames); $i++) {
            Prescription::create([
                'STT' => $i+1,
                'heath_book_id' => $idHeathBook,
                'drug_name' => $drugNames[$i],
                'quantity' => $quantities[$i],
                'time' => $times[$i],
            ]);
        }
        return redirect('doctor-medical-history')->with('message', 'Create Heath Book Successfully!'); ;
        
    }
}
