<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
     public function index(){

        $listDoctor = Doctor::all();  
        $listSpecialty = Specialty::all();   
        return view('admin.doctor.doctor', compact('listDoctor','listSpecialty')); 
    }
    
    public function addview(){
        $listSpecialty = Specialty::all();
        return view('admin.doctor.add_doctor',compact('listSpecialty'));
    }

    public function upload(Request $request){
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('doctors', 'email')
            ],
            
        ]);
    
        $doctor = new Doctor;
        $image = $request->file;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->file->move('doctorimage', $imagename);
        $doctor->image = $imagename;
        $doctor->name = $request->name;
        $doctor->room = $request->room;
        $doctor->phone = $request->phone; 
        $doctor->specialty_id = $request->specialty;
        $doctor->password = Hash::make($request->password);
        $doctor->email = $request->email; 
        $doctor->save(); 
    
        return redirect()->route('view-doctor')->with('message', 'Doctor Added Successfully'); 
    }
   


    public function editDoctor($id) {
        $doctor = Doctor::find($id);

        if ($doctor) {
            $listSpecialty = Specialty::all();
            return view('admin.doctor.update_doctor', compact('doctor','listSpecialty'));
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
            $doctor->phone = $request->phone;
            
            $doctor->room = $request->room;
            $doctor->specialty_id = $request->specialty_id;
            $doctor->save();
 
            return redirect()->route('view-doctor')->with('message', 'Doctor Updated Successfully');
        }
    
        return redirect()->back()->with('message', 'Doctor not found');
    }


    public function deleteDoctor($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return redirect()->back()->with('error', 'Doctor not found.');
        }

        $doctor->delete();

        return redirect()->route('view-doctor')->with('success', 'Doctor deleted successfully.');
    }


    //USER
    function getAllUser(){
        $listUser = User::all();
        return view('admin.user.user',compact('listUser'));
    }

    public function addUser() {  
        return view('admin.user.add_user');
    }
    


    public function insertUser(Request $request) {  
        $user = new User();
         
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->created_at = $request->created_at;
        $user->address = $request->address;
        $user->usertype = $request->role;

        $user->password = Hash::make($request->password);
        $user->save(); 
    
        return redirect('view-user')->with('message', 'User Added Successfully'); 
    } 


    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect('view-user') ->with('success', 'User deleted successfully.');
    }


}