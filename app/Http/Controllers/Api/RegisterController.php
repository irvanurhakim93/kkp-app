<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('registrasi');
    }

    public function registerProcess(Request $request)
    {



    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);


        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ],201);
        }

        if ($user) {
            return response()->json([
                'success' => false,
            ],409);
        }

    }

    public function requestOtp(Request $request){
        $otp = rand(1000,9999);
        Log::info("otp = ".$otp);
        $user = User::where('email','=',$request->email)->update(['otp' => $otp]);

        if($user){
            $mail_details = [
                'subject' => 'Kode OTP Anda',
                'body' => 'Kode OTP Anda adalah :' . $otp
            ];

            \Mail::to($request->email)->send(new sendEmail($mail_details));

            return response(["status" => 200, "message" => "Kode OTP berhasil dikirim"]);
        } else {
           return response(["status" => 401, "message" => "invalid"]); 
        }
    }


}
