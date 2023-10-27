<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function addview(){
        $listSpecialty = Specialty::all();
        return view('admin.doctor.add_doctor',compact('listSpecialty'));
    }

    public function upload(Request $request){
        $doctor = new Doctor;
        $image = $request->file;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request ->file-> move('doctorimage', $imagename);
        $doctor ->image = $imagename;
        $doctor ->name = $request->name;
        $doctor ->room = $request->room;
        $doctor ->phone = $request->phone; 
        $doctor ->specialty_id = $request->specialty;
        $doctor->password = Hash::make($request->password);

        $doctor->email = $request->email; 
        
        $doctor ->save(); 
        return redirect()->back()->with('message','Doctor Added Successfully');


    }
    public function index( ){

        $listDoctor = Doctor::all();  
        $listSpecialty = Specialty::all();  


        return view('admin.doctor.doctor', compact('listDoctor','listSpecialty'));
    
    }


    public function editDoctor($id) {
        $doctor = Doctor::find($id);

        if ($doctor) {
            return view('admin.doctor.update_doctor', compact('doctor'));
        }

        return redirect()->back()->with('message', 'Doctor not found');
    }

   


    public function update(Request $request, $id){
        $doctor = Doctor::find($id);
    
        if ($doctor) {
            if ($request->hasFile('file')) {
                $image = $request->file;
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $request->file->move('doctorimage', $imageName);
                $doctor->image = $imageName;
            }
    
            $doctor->name = $request->name;
            $doctor->room = $request->room;
            $doctor->specialty = $request->specialty;
            $doctor->save();
    
            return redirect()->back()->with('message', 'Doctor Updated Successfully');
        }
    
        return redirect()->back()->with('message', 'Doctor not found');
    }
}
