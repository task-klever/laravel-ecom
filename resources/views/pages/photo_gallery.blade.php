@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_photo_gallery) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $photo_gallery->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $photo_gallery->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content mt_30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $photo_gallery->detail !!}
                </div>
            </div>
            <div class="row">

                @foreach ($photos as $row)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="gallery-photo">
                        <div class="gallery-photo-bg"></div>
                        <a href="{{ asset('uploads/'.$row->photo_name) }}" class="magnific" title="{{ asset('uploads/'.$row->photo_caption) }}">
                            <img src="{{ asset('uploads/'.$row->photo_name) }}">
                            <div class="plus-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
