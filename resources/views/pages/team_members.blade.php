@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_team_member) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $team_member->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $team_member->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $team_member->detail !!}
                </div>
            </div>
            <div class="row team pt_0 pb_40">
                @foreach($team_members as $row)
                    <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="team-item">
                            <div class="team-photo">
                                <a href="{{ url('team-member/'.$row->slug) }}" class="team-photo-anchor">
                                    <img src="{{ asset('uploads/'.$row->photo) }}" alt="Team Member Photo">
                                </a>
                            </div>
                            <div class="team-text">
                                <h4><a href="{{ url('team-member/'.$row->slug) }}">{{ $row->name }}</a></h4>
                                <p>{{ $row->designation }}</p>
                                @if($row->facebook != '' || $row->twitter != '' || $row->linkedin != '' || $row->youtube != '' || $row->instagram != '')
                                <div class="team-social">
                                    <ul>
                                        @if($row->facebook != '')
                                            <li><a href="{{ $row->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif

                                        @if($row->twitter != '')
                                            <li><a href="{{ $row->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        @endif

                                        @if($row->linkedin != '')
                                            <li><a href="{{ $row->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        @endif
                                        @if($row->youtube != '')
                                            <li><a href="{{ $row->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                        @endif
                                        @if($row->instagram != '')
                                            <li><a href="{{ $row->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        @endif

                                    </ul>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $team_members->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
