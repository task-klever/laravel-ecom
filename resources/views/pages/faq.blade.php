@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_faq) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $faq->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $faq->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $faq->detail !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 faq">
                    <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                        @php $i=0; @endphp
                        @foreach ($faqs as $row)
                            @php $i++; @endphp
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{ $i }}">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
                                        {{ $row->faq_title }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $i }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $i }}">
                                <div class="panel-body">
                                    {!! $row->faq_content !!}
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
