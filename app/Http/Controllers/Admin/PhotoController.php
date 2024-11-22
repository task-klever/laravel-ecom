<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class PhotoController extends Controller
{
    public function index()
    {
        $photo = Photo::orderBy('photo_order')->get();
        return view('admin.photo.index', compact('photo'));
    }

    public function create()
    {
        return view('admin.photo.create');
    }

    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $photo = new Photo();
        $data = $request->only($photo->getFillable());

        $request->validate([
            'photo_name' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_order' => 'numeric|min:0|max:32767'
        ]);

        $statement = DB::select("SHOW TABLE STATUS LIKE 'photos'");
        $ai_id = $statement[0]->Auto_increment;
        $ext = $request->file('photo_name')->extension();
        $final_name = 'photo-'.$ai_id.'.'.$ext;
        $request->file('photo_name')->move(public_path('uploads/'), $final_name);
        $data['photo_name'] = $final_name;

        $photo->fill($data)->save();
        return redirect()->route('admin.photo.index')->with('success', 'Photo is added successfully!');
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.photo.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $photo = Photo::findOrFail($id);
        $data = $request->only($photo->getFillable());

        if($request->hasFile('photo_name')) {
            $request->validate([
                'photo_name' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'photo_order' => 'numeric|min:0|max:32767'
            ]);
            unlink(public_path('uploads/'.$photo->photo_name));
            $ext = $request->file('photo_name')->extension();
            $final_name = 'photo-'.$id.'.'.$ext;
            $request->file('photo_name')->move(public_path('uploads/'), $final_name);
            $data['photo_name'] = $final_name;
        } else {
            $request->validate([
                'photo_order' => 'numeric|min:0|max:32767'
            ]);
            $data['photo_name'] = $photo->photo_name;
        }

        $photo->fill($data)->save();
        return redirect()->route('admin.photo.index')->with('success', 'Photo is updated successfully!');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $photo = Photo::findOrFail($id);
        unlink(public_path('uploads/'.$photo->photo_name));
        $photo->delete();
        return Redirect()->back()->with('success', 'Photo is deleted successfully!');
    }
}
