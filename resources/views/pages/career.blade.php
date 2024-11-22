@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_career) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $career->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $career->name }}</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $career->detail !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="career">

                        @foreach ($jobs as $row)
                        <div class="career-main-item">
                            <h3>{{ $row->job_title }}</h3>
                            <h4>{{ COMPANY_COLON }} {{ $row->job_company_name }} | {{ DEADLINE_COLON }} {{ $row->job_deadline }}</h4>
                            <p>
                                {!! nl2br(e($row->job_description_short)) !!}
                            </p>
                            <div class="row long">
                                <div class="col-md-4">
                                    <div class="btn btn-secondary btn-sm btn-block"><i class="fa fa-map-marker"></i> {{ $row->job_location }}</div>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('job/'.$row->job_slug) }}" class="btn btn-success btn-sm btn-block">{{ SEE_DETAIL }}</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('job/apply/'.$row->job_slug) }}" class="btn btn-danger btn-sm btn-block">{{ APPLY_NOW }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
