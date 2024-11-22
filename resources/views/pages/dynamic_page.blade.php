@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$dynamic_page_detail->dynamic_page_banner) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $dynamic_page_detail->dynamic_page_name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $dynamic_page_detail->dynamic_page_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $dynamic_page_detail->dynamic_page_content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
