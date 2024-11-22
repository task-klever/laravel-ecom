<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PagePhotoGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class PagePhotoGalleryController extends Controller
{
    public function edit()
    {
        $page_photo_gallery = PagePhotoGalleryItem::where('id',1)->first();
        return view('admin.page_setting.page_photo_gallery', compact('page_photo_gallery'));
    }

     public function update(Request $request)
     {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
         $data['name'] = $request->input('name');
         $data['detail'] = $request->input('detail');
         $data['status'] = $request->input('status');
         $data['seo_title'] = $request->input('seo_title');
         $data['seo_meta_description'] = $request->input('seo_meta_description');

         PagePhotoGalleryItem::where('id',1)->update($data);

         return redirect()->back()->with('success', 'Photo Gallery Page Content is updated successfully!');

     }

}
