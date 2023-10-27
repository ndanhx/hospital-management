<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
class HomeController extends Controller


{
    public function redirect(){
        if(Auth::id())
        {
            if(Auth::user()->usertype=='0'){
                $listDoctor = Doctor::all(); 
                $listSpecialty = Specialty::all();
                return view('user.home', compact('listDoctor','listSpecialty')); 
            }
            else
            {
                return view('admin.home');
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function index(){
        $listDoctor = Doctor::all();
        $listSpecialty = Specialty::all();

        return view('user.home', compact('listDoctor','listSpecialty'));
    }
}
