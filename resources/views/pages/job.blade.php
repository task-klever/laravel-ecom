@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_job) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ JOB_TITLE_COLON }} {{ $job_detail->job_title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $job_detail->job_title }}</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="career-detail">
                        <div class="item">
                            <h3>{{ JOB_TITLE }}</h3>
                            <p>
                                {{ $job_detail->job_title }}
                            </p>
                        </div>
                        <div class="item">
                            <h3>{{ JOB_RESPONSIBILITIES }}</h3>
                            {!! $job_detail->job_responsibility !!}
                        </div>

                        <div class="item">
                            <h3>{{ EDUCATIONAL_QUALIFICATION }}</h3>
                            {!! $job_detail->job_education !!}
                        </div>
                        <div class="item">
                            <h3>{{ EXPERIENCE_REQUIREMENT }}</h3>
                            {!! $job_detail->job_experience !!}
                        </div>
                        <div class="item">
                            <h3>{{ ADDITIONAL_REQUIREMENT }}</h3>
                            {!! $job_detail->job_additional_requirement !!}
                        </div>
                        <div class="item">
                            <h3>{{ OTHER_BENEFIT }}</h3>
                            {!! $job_detail->job_benefit !!}
                        </div>
                        <div class="item">
                            <a href="{{ url('job/apply/'.$job_detail->job_slug) }}" class="btn btn-primary btn-arf">{{ APPLY_NOW }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="career-sidebar">
                        <div class="widget">
                            <h3>{{ ABOUT_THIS_JOB }}</h3>
                            <div class="career-detail-sidebar">
                                <div class="item">
                                    <h4>{{ VACANCY }}</h4>
                                    <p>{{ $job_detail->job_vacancy }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ COMPANY_NAME }}</h4>
                                    <p>{{ $job_detail->job_company_name }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ JOB_LOCATION }}</h4>
                                    <p>{{ $job_detail->job_location }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ APPLICATION_DEADLINE }}</h4>
                                    <p>{{ $job_detail->job_deadline }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ JOB_TYPE }}</h4>
                                    <p>{{ $job_detail->job_type }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ SALARY }}</h4>
                                    <p>{{ $job_detail->job_salary }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
