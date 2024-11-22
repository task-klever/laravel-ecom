<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Hash;
use Auth;

class PasswordChangeController extends Controller
{
    public function index()
    {
        return view('admin.auth.password_change');
    }

    public function update(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $request->validate([
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($request->password);
        Admin::where('id',Auth::guard('admin')->user()->id)->update($data);

        return redirect()->back()->with('success', 'Password is updated successfully!');

    }

}
