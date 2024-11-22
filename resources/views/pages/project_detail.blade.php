@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_project_detail) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $project_detail->project_name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.projects') }}">{{ PROJECTS }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $project_detail->project_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="single-section single-project">

                        <div class="text mt_20">
                            <h2>{{ PROJECT_DETAIL }}</h2>
                            <p>
                                <img src="{{ asset('uploads/'.$project_detail->project_featured_photo) }}" class="featured-photo">
                            </p>
                            <p>
                                {!!  $project_detail->project_content !!}
                            </p>

                            <h2 class="mt_30">{{ PROJECT_PHOTOS }}</h2>
                            <div class="project-photo-carousel owl-carousel">

                                @foreach ($project_photos as $row)
                                <div class="p-item">
                                    <div class="p-item-bg"></div>
                                    <a href="{{ asset('uploads/'.$row->project_photo) }}" class="magnific" title="{{ $row->project_photo_caption }}">
                                        <img src="{{ asset('uploads/'.$row->project_photo) }}" alt="Project Photo">
                                        <div class="plus-icon">
                                            <i class="fa fa-search-plus"></i>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>

                            <h2 class="mt_30">{{ PROJECT_VIDEO }}</h2>
                            <div class="iframe-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $project_detail->project_video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sidebar">

                        <div class="widget">
                            <h3>{{ PROJECT_INFORMATION }}</h3>
                            <div class="project-detail">
                                <div class="item">
                                    <h4>{{ CLIENT_NAME }}</h4>
                                    <p>{{ $project_detail->project_client_name }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ CLIENT_COMPANY_NAME }}</h4>
                                    <p>{{ $project_detail->project_client_company }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ PROJECT_START_DATE }}</h4>
                                    <p>{{ $project_detail->project_start_date }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ PROJECT_END_DATE }}</h4>
                                    <p>{{ $project_detail->project_end_date }}</p>
                                </div>
                                <div class="item">
                                    <h4>{{ CLIENT_COMMENT }}</h4>
                                    <p>
                                        {!! nl2br(e($project_detail->project_client_comment)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="widget">
                            <h3>{{ ALL_PROJECTS }}</h3>
                            <div class="type-2">
                                <ul>
                                    @foreach($project_items as $row)
                                        <li>
                                            <img src="{{ asset('uploads/'.$row->project_featured_photo) }}">
                                            <a href="{{ url('project/'.$row->project_slug) }}">{{ $row->project_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
