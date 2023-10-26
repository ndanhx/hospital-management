<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\Specialty;

class AdminController extends Controller
{
    public function addview(){
        $listSpecialty = Specialty::all();
        return view('admin.doctor.add_doctor',compact('listSpecialty'));
    }

    public function upload(Request $request){
        $doctor = new doctor;
        $image = $request->file;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request ->file-> move('doctorimage', $imagename);
        $doctor ->image = $imagename;
        $doctor ->name = $request->name;
        $doctor ->room = $request->room;
        $doctor ->phone = $request->phone; 
        $doctor ->specialty_id = $request->specialty;
        $doctor ->save();

        
        return redirect()->back()->with('message','Doctor Added Successfully');


    }
    public function index( ){

        $listDoctor = Doctor::all();  
        $listSpecialty = Specialty::all();  


        return view('admin.doctor.doctor', compact('listDoctor','listSpecialty'));
    
    }
}
