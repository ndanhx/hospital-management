<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Specialty;
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

    function viewAppointment() //by admin
    {
        $listSpecialty = Specialty::all();

        $today = now()->toDateString();
        $appointmentsToUpdate = Appointment::where('status', 'pending')
                                    ->where('date_request', '<', $today)
                                    ->get();
    
        foreach ($appointmentsToUpdate as $appointment) {
            $appointment->status = 'cancel';  
            $appointment->save();
        }

        $listAppointment = Appointment::orderBy('id', 'desc')->paginate(5);
        return view('admin.appointment.appointment', compact('listAppointment','listSpecialty'));
    }
    
    public function updateStatus($id)
    { 
        $appointment = Appointment::find($id);
        if ($appointment && $appointment->status === 'pending') {
            $appointment->status = 'approved';
            $appointment->doctor_id =  Auth::guard('doctor')->user()->id;
           $appointment->save();

           return redirect()->back()->with('message', 'Trạng thái cuộc hẹn đã được cập nhật thành công.');
       
        } else {
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái cuộc hẹn.');
        }
    }

    function cancelStatus(Request $request){
        $appointment_id =  $request->input('appointment_id'); 
        $appointment = Appointment::find($appointment_id);
        $appointment->status = 'cancel'; 
        $appointment->save();
        return redirect()->back()->with('message', 'Trạng thái cuộc hẹn đã được cập nhật thành công.');

    }


     

     function requestVIP(Request $request){ 

        $appointment = new Appointment;
        $appointment->user_id = Auth::id();  
        $appointment->name = Auth::user()->name;
        $appointment->email = Auth::user()->email;
        $appointment->date_request = $request->input('date');
        $appointment->specialty_id = $request->input('specialty_id');
        $appointment->phone = $request->input('phone');
        $appointment->message = $request->input('message');
        $appointment->status =  'approved';
        $appointment->doctor_id =   $request->input('doctor_id'); 

        $amount = $request->input('amount'); 

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        //URL DEPLOYED
        $vnp_Returnurl  = "https://one-heath-7b2c7f266b02.herokuapp.com/user-view-appointment2?user_id=$appointment->user_id&name=$appointment->name&email=$appointment->email&date_request=$appointment->date_request&specialty_id=$appointment->specialty_id&message=$appointment->message&status=$appointment->status&doctor_id=$appointment->doctor_id&phone=$appointment->phone";
        // $vnp_Returnurl  = "http://127.0.0.1:8000/user-view-appointment2?user_id=$appointment->user_id&name=$appointment->name&email=$appointment->email&date_request=$appointment->date_request&specialty_id=$appointment->specialty_id&message=$appointment->message&status=$appointment->status&doctor_id=$appointment->doctor_id&phone=$appointment->phone";
        $vnp_TmnCode = "81ONK5NW";//Mã website tại VNPAY 
        $vnp_HashSecret = "DVDUOOLSYNRMGFPHRSHRMRZXOYMUZQVP"; //Chuỗi bí mật
        
        $vnp_TxnRef = rand(1, 999999);; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'thanh toan hoa don';
        $vnp_OrderType = 'Book Heath Care';
        $vnp_Amount =  $amount * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
         
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef 
        );
        
        // if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        //     $inputData['vnp_BankCode'] = $vnp_BankCode;
        // }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
                            , 'message' => 'success'
                            , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
            

    }

    
    
}