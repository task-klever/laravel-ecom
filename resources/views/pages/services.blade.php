@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_service) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $service->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $service->detail !!}
                </div>
            </div>
            <div class="row service pt_0 pb_0">
                @foreach($service_items as $row)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="service-item wow fadeInUp mb_30">
                            <div class="photo">
                                <a href="{{ url('service/'.$row->slug) }}"><img src="{{ asset('uploads/'.$row->photo) }}" alt=""></a>
                            </div>
                            <div class="text">
                                <h3><a href="{{ url('service/'.$row->slug) }}">{{ $row->name }}</a></h3>
                                <p>{{ $row->short_description }}</p>
                                <div class="read-more">
                                    <a href="{{ url('service/'.$row->slug) }}">{{ READ_MORE }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $service_items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
