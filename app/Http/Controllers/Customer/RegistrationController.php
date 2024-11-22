<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationEmailToCustomer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Hash;
use DB;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
    	return view('customer.auth.registration', compact('g_setting'));
    }

    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $token = hash('sha256',time());

        $customer = new Customer();
        $data = $request->only($customer->getFillable());

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:customers',
                'password' => 'required',
                're_password' => 'required|same:password'
            ],
            [],
            [
                'name' => 'Customer Name',
                'email' => 'Customer Email',
                'password' => 'Customer Password',
                're_password' => 'Customer Retype Password'
            ]
        );

        if($g_setting->google_recaptcha_status == 'Show') {
            $request->validate([
                'g-recaptcha-response' => 'required'
            ],
            [
                'g-recaptcha-response.required' => 'You must have to input recaptcha correctly'
            ]);
        }

        unset($request->re_password);
        $data['password'] = Hash::make($request->password);
        $data['phone'] = '';
        $data['country'] = '';
        $data['address'] = '';
        $data['state'] = '';
        $data['city'] = '';
        $data['zip'] = '';
        $data['token'] = $token;
        $data['status'] = 'Pending';

        $customer->fill($data)->save();

        // Send Email
        $email_template_data = DB::table('email_templates')->where('id', 6)->first();
        $subject = $email_template_data->et_subject;
        $message = $email_template_data->et_content;

        $verification_link = url('customer/registration/verify/'.$token.'/'.$request->email);

        $message = str_replace('[[verification_link]]', $verification_link, $message);

        Mail::to($request->email)->send(new RegistrationEmailToCustomer($subject,$message));

        return redirect()->back()->with('success', 'Please check your email to verify your registration. Check your spam folder too.');
    }

    public function verify()
    {
        $email_from_url = request()->segment(count(request()->segments()));
        $aa = DB::table('customers')->where('email', $email_from_url)->first();

        if(!$aa) {
            return redirect()->route('customer.login');
        }

        $expected_url = url('customer/registration/verify/'.$aa->token.'/'.$aa->email);
        $current_url = url()->current();
        if($expected_url != $current_url) {
            return redirect()->route('customer.login');
        }

        $data['status'] = 'Active';
        $data['token'] = '';
        Customer::where('email',$email_from_url)->update($data);

        return redirect()->route('customer.login')->with('success', 'Registration is completed. You can now login.');
    }

}
