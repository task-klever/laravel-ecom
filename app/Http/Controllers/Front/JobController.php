<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use DB;

class JobController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $career = DB::table('page_career_items')->where('id', 1)->first();
        $jobs = DB::table('jobs')->orderby('job_order', 'asc')->get();
        return view('pages.career', compact('career','g_setting','jobs'));
    }

    public function detail($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $job_detail = DB::table('jobs')->where('job_slug', $slug)->first();
        return view('pages.job', compact('job_detail','g_setting'));
    }

    public function apply($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $job_detail = DB::table('jobs')->where('job_slug', $slug)->first();
        return view('pages.job_apply', compact('job_detail','g_setting'));
    }

    public function apply_form(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $g_setting = DB::table('general_settings')->where('id', 1)->first();

        $job_application = new JobApplication();
        $data = $request->only($job_application->getFillable());

        $request->validate([
            'applicant_first_name' => 'required',
            'applicant_last_name' => 'required',
            'applicant_email' => 'required|email',
            'applicant_phone' => 'required',
            'applicant_country' => 'required',
            'applicant_state' => 'required',
            'applicant_street' => 'required',
            'applicant_city' => 'required',
            'applicant_zip_code' => 'required',
            'applicant_expected_salary' => 'required',
            'applicant_cover_letter' => 'required',
            'applicant_cv' => 'required|mimes:doc,docx,pdf|max:2048'
        ]);

        if($g_setting->google_recaptcha_status == 'Show') {
            $request->validate([
                'g-recaptcha-response' => 'required'
            ],
            [
                'g-recaptcha-response.required' => 'You must have to input recaptcha correctly'
            ]);
        }

        $statement = DB::select("SHOW TABLE STATUS LIKE 'job_applications'");
        $ai_id = $statement[0]->Auto_increment;

        $ext = $request->file('applicant_cv')->extension();
        $final_name = 'cv-'.$ai_id.'.'.$ext;
        $request->file('applicant_cv')->move(public_path('uploads/'), $final_name);
        $data['applicant_cv'] = $final_name;

        $job_application->fill($data)->save();

        return redirect()->back()->with('success', 'Your application is submitted successfully. You will notified by email if you are selected for the interview.');
    }
}
