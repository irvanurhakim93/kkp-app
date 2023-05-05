<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

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


}
