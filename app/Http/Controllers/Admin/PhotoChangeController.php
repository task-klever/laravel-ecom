<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class PhotoChangeController extends Controller
{
    public function index()
    {
        return view('admin.auth.photo_change');
    }

    public function update(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Unlink old photo
        unlink(public_path('uploads/'.$request->current_photo));

        // Uploading new photo
        $ext = $request->file('photo')->extension();
        $final_name = 'user-'.Auth::guard('admin')->user()->id.'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        $data['photo'] = $final_name;

        Admin::where('id',Auth::guard('admin')->user()->id)->update($data);

        return redirect()->back()->with('success', 'Photo is updated successfully!');

    }

}
