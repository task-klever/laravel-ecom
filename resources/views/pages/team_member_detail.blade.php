@extends('layouts.app')

@section('content')
<div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_team_member_detail) }})">
    <div class="bg-page"></div>
    <div class="text">
        <h1>{{ $team_member_detail->name }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.team_members') }}">{{ TEAM_MEMBERS }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $team_member_detail->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row team-single">
            <div class="col-md-4">
                <div class="team-member-photo">
                    <img src="{{ asset('uploads/'.$team_member_detail->photo) }}" alt="">
                </div>
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>{{ NAME }}</td>
                            <td>{{ $team_member_detail->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ DESIGNATION }}</td>
                            <td>{{ $team_member_detail->designation }}</td>
                        </tr>
                        <tr>
                            <td>{{ ADDRESS }}</td>
                            <td>
                                {!! nl2br(e($team_member_detail->address)) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ EMAIL_ADDRESS }}</td>
                            <td>{{ $team_member_detail->email }}</td>
                        </tr>
                        <tr>
                            <td>{{ PHONE }}</td>
                            <td>{{ $team_member_detail->phone }}</td>
                        </tr>
                        <tr>
                            <td>{{ WEBSITE }}</td>
                            <td>{{ $team_member_detail->website }}</td>
                        </tr>
                        @if($team_member_detail->facebook != '' ||$team_member_detail->twitter != '' ||$team_member_detail->linkedin != '' ||$team_member_detail->youtube != '' ||$team_member_detail->instagram != '')
                        <tr>
                            <td>{{ SOCIAL_MEDIA }}</td>
                            <td>
                                <ul class="doc_detail_social">

                                    @if($team_member_detail->facebook!='')
                                    <li><a href="{{ $team_member_detail->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif

                                    @if($team_member_detail->twitter!='')
                                        <li><a href="{{ $team_member_detail->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    @endif

                                    @if($team_member_detail->linkedin!='')
                                        <li><a href="{{ $team_member_detail->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif

                                    @if($team_member_detail->youtube!='')
                                        <li><a href="{{ $team_member_detail->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                    @endif

                                    @if($team_member_detail->instagram!='')
                                        <li><a href="{{ $team_member_detail->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                </ul>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="row team-single">
            <div class="col-md-12">

                <div class="description mt_30">
                    <ul class="nav nav-pills mb-3 nav-doctor" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-tab-1" data-toggle="pill" href="#pills-t-1" role="tab" aria-controls="pills-t-1" aria-selected="true">{{ DEGREE }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-tab-2" data-toggle="pill" href="#pills-t-2" role="tab" aria-controls="pills-t-2" aria-selected="false">{{ DETAILS }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-tab-5" data-toggle="pill" href="#pills-t-5" role="tab" aria-controls="pills-t-5" aria-selected="false">{{ VIDEO }}</a>
                        </li>
                    </ul>
                    <div class="tab-content nav-doctor-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-t-1" role="tabpanel" aria-labelledby="pills-tab-1">
                            @if($team_member_detail->degree == '')
                            {{ NO_RESULT_FOUND }}
                            @else
                                {!! $team_member_detail->degree !!}
							@endif
                        </div>
                        <div class="tab-pane fade" id="pills-t-2" role="tabpanel" aria-labelledby="pills-tab-2">
                            @if($team_member_detail->detail == '')
                                {{ NO_RESULT_FOUND }}
                            @else
                                {!! $team_member_detail->detail !!}
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-t-5" role="tabpanel" aria-labelledby="pills-tab-5">
                            @if($team_member_detail->video_youtube == '')
                                {{ NO_RESULT_FOUND }}
                            @else
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $team_member_detail->video_youtube }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
