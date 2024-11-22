@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_customer_panel) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Change Profile Information</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Change Profile Information</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">

                <div class="col-md-3">				
                    <div class="user-sidebar">
                        @include('layouts.sidebar_customer')
                    </div>
                </div>

                <div class="col-md-9">
                    <form action="{{ url('customer/profile-change/update') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name *</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->name }}" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email Address *</label>
                                    <input type="email" class="form-control" value="{{ Auth::guard('customer')->user()->email }}" name="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->phone }}" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->country }}" name="country">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->address }}" name="address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->state }}" name="state">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->city }}" name="city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Zip Code</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->zip }}" name="zip">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Information</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
