<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class ProfileChangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $customer_data = Customer::where('id',Auth::guard('customer')->user()->id)->first();
        return view('customer.pages.profile_change', compact('customer_data','g_setting'));
    }

    public function update(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $request->validate([
            'name' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['country'] = $request->country;
        $data['address'] = $request->address;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['zip'] = $request->zip;

        Customer::where('id',Auth::guard('customer')->user()->id)->update($data);

        return redirect()->back()->with('success', 'Profile Information is updated successfully!');

    }

}
