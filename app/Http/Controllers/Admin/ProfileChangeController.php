<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class ProfileChangeController extends Controller
{
    public function index()
    {
        return view('admin.auth.profile_change');
    }

    public function update(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;

        Admin::where('id',Auth::guard('admin')->user()->id)->update($data);

        return redirect()->back()->with('success', 'Profile Information is updated successfully!');

    }

}
