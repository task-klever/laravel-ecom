<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $video_gallery = DB::table('page_video_gallery_items')->where('id', 1)->first();
        $videos = DB::table('videos')->orderby('video_order', 'asc')->get();
        return view('pages.video_gallery', compact('video_gallery','g_setting','videos'));
    }
}
