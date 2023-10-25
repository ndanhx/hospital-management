<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;

class AdminController extends Controller
{
    public function addview(){
        
        return view('admin.doctor.add_doctor');
    }

    public function upload(Request $request){
        $doctor = new doctor;
        $image = $request->file;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request ->file-> move('doctorimage', $imagename);
        $doctor ->image = $imagename;
        $doctor ->name = $request->name;
        $doctor ->room = $request->room;
        $doctor ->specialty = $request->specialty;
        $doctor ->save();

        
        return redirect()->back()->with('message','Doctor Added Successfully');


    }
    public function index( ){
        
        return view('');
    
    }
}
