<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use DB;
use App\Mail\CommentMessageToAdmin;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $blog = DB::table('page_blog_items')->where('id', 1)->first();
        $blog_items = DB::table('blogs')->orderby('id', 'desc')->paginate(4);
        $blog_items_no_pagi = DB::table('blogs')->orderby('id', 'desc')->get();
        $categories = DB::table('categories')->get();
        return view('pages.blogs', compact('blog','g_setting','blog_items','categories','blog_items_no_pagi'));
    }

    public function detail($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $blog_detail = DB::table('blogs')->where('blog_slug', $slug)->first();
        $blog_items = DB::table('blogs')->get();
        $blog_items_no_pagi = DB::table('blogs')->orderby('id', 'desc')->get();
        $categories = DB::table('categories')->get();
        if(!$blog_detail) {
            return abort(404);
        }
        $comments = '';
        $comments = DB::table('comments')->where('blog_id', $blog_detail->id)->where('comment_status', 'Approved')->get();
        return view('pages.blog_detail', compact('g_setting','blog_detail','blog_items','blog_items_no_pagi','categories','comments'));
    }

    public function comment(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $comment = new Comment();
        $data = $request->only($comment->getFillable());

        $request->validate([
            'person_name' => 'required',
            'person_email' => 'required|email',
            'person_message' => 'required'
        ]);
        $comment->fill($data)->save();

        // Send email to admin
        $email_template_data = DB::table('email_templates')->where('id', 2)->first();
        $subject = $email_template_data->et_subject;
        $message = $email_template_data->et_content;

        $comment_see_url = url('admin/comment/pending');

        $message = str_replace('[[person_name]]', $request->person_name, $message);
        $message = str_replace('[[person_email]]', $request->person_email, $message);
        $message = str_replace('[[person_message]]', $request->person_message, $message);
        $message = str_replace('[[comment_see_url]]', $comment_see_url, $message);

        $admin_data = DB::table('admins')->where('id',1)->first();

        Mail::to($admin_data->email)->send(new CommentMessageToAdmin($subject,$message));
        return redirect()->back()->with('success', 'Your comment is sent to admin successfully. Admin will check and approve it.');
    }
}
