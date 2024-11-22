<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $project = DB::table('page_project_items')->where('id', 1)->first();
        $project_items = DB::table('projects')->paginate(9);

        return view('pages.projects', compact('project','g_setting','project_items'));
    }

    public function detail($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $project_detail = DB::table('projects')->where('project_slug', $slug)->first();
        $project_items = DB::table('projects')->get();
        if(!$project_detail) {
            return abort(404);
        }

        $project_photos = DB::table('project_photos')->where('project_id', $project_detail->id)->get();

        return view('pages.project_detail', compact('g_setting','project_detail','project_items','project_photos'));
    }
}
