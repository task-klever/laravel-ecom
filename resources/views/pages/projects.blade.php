@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_project) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $project->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $project->detail !!}
                </div>
            </div>
            <div class="row project pt_0 pb_0">
                @foreach($project_items as $row)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="project-item wow fadeInUp mb_30">
                            <div class="photo">
                                <a href="{{ url('project/'.$row->project_slug) }}"><img src="{{ asset('uploads/'.$row->project_featured_photo) }}" alt=""></a>
                            </div>
                            <div class="text">
                                <h3><a href="{{ url('project/'.$row->project_slug) }}">{{ $row->project_name }}</a></h3>
                                <p>{{ $row->project_content_short }}</p>
                                <div class="read-more">
                                    <a href="{{ url('project/'.$row->project_slug) }}">{{ READ_MORE }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $project_items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
