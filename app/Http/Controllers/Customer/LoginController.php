<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Hash;
use DB;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
    	return view('customer.auth.login', compact('g_setting'));
    }

    public function store(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();

        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ], [],
            [
                'email' => 'Customer Email',
                'password' => 'Customer Password'
            ]
        );

        if($g_setting->google_recaptcha_status == 'Show') {
            $request->validate([
                'g-recaptcha-response' => 'required'
            ],
            [
                'g-recaptcha-response.required'    => 'You must have to input recaptcha correctly'
            ]);
        }

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Active'
        ];

        if(Auth::guard('customer')->attempt($credential)) {
            return redirect()->route('customer.dashboard');
        } else {
            return redirect()->route('customer.login')->with('error', 'Information is not correct!');
        }
    }
}
