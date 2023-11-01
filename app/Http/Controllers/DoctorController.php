<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App; 
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\HeathBook;
use App\Models\Prescription;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;

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

        
        $today = now()->toDateString();
        $appointmentsToUpdate = Appointment::where('status', 'pending')
                                    ->where('date_request', '<', $today)
                                    ->get();
    
        foreach ($appointmentsToUpdate as $appointment) {
            $appointment->status = 'cancel';  
            $appointment->save();
        }


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
        $listMedicalHistory  = HeathBook::where('doctor_id', $doctorId)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $listUser = User::all();
        return view('doctor.heath_book.medical_history',compact('listMedicalHistory','listUser'));
    }


    function  HeathBookDetailDoctor($id){
        $heathBook  = HeathBook::find($id); 

        $user = User::find($heathBook->user_id);
        $listPrescriptions = Prescription::where('heath_book_id',$heathBook->id) ->get();
     
        $doctor = Doctor::where('id',$heathBook->doctor_id)->get();

        return view('doctor.heath_book.heath_book_detail',compact('user','listPrescriptions','heathBook','doctor'));
    }

    function  printPDFDoctor($id){
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->printPDFDoctor_convert($id));
        return $pdf->stream();
        
    }
 
    public function printPDFDoctor_convert($id){
        $heathBook  = HeathBook::find($id);
        $heathBook  = HeathBook::find($id);  
        $user = User::find($heathBook->user_id);
        $listPrescriptions = Prescription::where('heath_book_id',$heathBook->id) ->get(); 
        $doctor = Doctor::where('id',$heathBook->doctor_id)->get(); 
        $data = [
            'user' => $user,
            'listPrescriptions' => $listPrescriptions,
            'heathBook' => $heathBook,
            'doctor' => $doctor,
            
        ];  
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
    
        $options->set('isPhpEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $html = view('doctor.heath_book.print_pdf', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        return $dompdf->stream('patient_information.pdf');
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
    

    public function getDoctorsBySpecialty($specialtyId)  {
        $doctors = Doctor::where('specialty_id', $specialtyId)->get();
        return response()->json($doctors)->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');

    }

    public function logout(){
        Auth::guard('doctor')->logout(); 
        return redirect('/doctor/login');
    }
    
    
    
    
    

    
    
    
}