@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_blog_detail) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $blog_detail->blog_title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.blogs') }}">{{ BLOGS }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $blog_detail->blog_title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="single-section">
                        <div class="featured-photo">
                            <img src="{{ asset('uploads/'.$blog_detail->blog_photo) }}">
                        </div>
                        <div class="text">
                            <h2>{{ $blog_detail->blog_title }}</h2>
                            <h3>
                                {{ POSTED_ON }} {{ \Carbon\Carbon::parse($blog_detail->created_at)->format('d M, Y') }}
                            </h3>
                            {!!  $blog_detail->blog_content !!}
                        </div>

                        <h2 class="mt_35">{{ SHARE_THIS }}</h2>
                        <div class="share_buttons">
                            <a class="facebook" target="_blank" href="http://www.facebook.com/sharer.php?u={{ url('blog/'.$blog_detail->blog_slug) }}&t={{ $blog_detail->blog_title }}"><i class="fab fa-facebook-f"></i></a>

                            <a class="twitter" target="_blank" href="https://twitter.com/share?text={{ $blog_detail->blog_title }}&url={{ url('blog/'.$blog_detail->blog_slug) }}"><i class="fab fa-twitter"></i></a>

                            <a class="pinterest" target="_blank" href="https://www.pinterest.com/pin/create/button/?description={{ $blog_detail->blog_title }}&media=&url={{ url('blog/'.$blog_detail->blog_slug) }}"><i class="fab fa-pinterest"></i></a>

                            <a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url={{ url('blog/'.$blog_detail->blog_slug) }}&title={{ $blog_detail->blog_title }}"><i class="fab fa-linkedin-in"></i></a>
                        </div>


                        <!-- Comment Section Started -->
                        <hr class="mt_50">
                        <div class="comment mt_50">

                            <h2 class="mb_40">{{ COMMENTS }} ({{ count($comments) }})</h2>

                            @if(count($comments) == 0)
                                <div class="text-danger">{{ NO_COMMENT_FOUND }}</div>
                            @else
                                @foreach($comments as $row)
                                    <div class="comment-item">
                                        <div class="text">
                                            <h4>{{ $loop->iteration . '. ' . $row->person_name }}</h4>
                                            <div class="date">{{ \Carbon\Carbon::parse($row->created_at)->format('d M, Y') }}</div>
                                            <div class="des">
                                                <p>
                                                    {!! nl2br(e($row->person_message)) !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <hr class="mt_50">

                            <h2 class="mt_35">{{ POST_YOUR_COMMENT }}</h2>
                            <form action="{{ route('front.comment') }}" method="post">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog_detail->id }}">
                                <input type="hidden" name="blog_slug" value="{{ $blog_detail->blog_slug }}">
                                <input type="hidden" name="comment_status" value="Pending">
                                <div class="row mb_20">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="{{ NAME }}" name="person_name">
                                    </div>
                                    <div class="col">
                                        <input type="email" class="form-control" placeholder="{{ EMAIL_ADDRESS }}" name="person_email">
                                    </div>
                                </div>
                                <div class="row mb_20">
                                    <div class="col">
                                        <textarea name="person_message" class="form-control h-200" cols="30" rows="10" placeholder="{{ COMMENT }}"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">{{ POST_COMMENT }}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- Comment Section End -->



                    </div>
                </div>
                <div class="col-md-4">
                    @include('layouts.sidebar_blog')
                </div>
            </div>
        </div>
    </div>
@endsection
