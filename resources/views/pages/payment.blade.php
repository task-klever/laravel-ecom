@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_checkout) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ PAYMENT }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ PAYMENT }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content pt_50 pb_60">
        <div class="container">
            <div class="row cart">
                <div class="col-md-12">
                    
                    <h3>{{ MAKE_PAYMENT }}</h3>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <select name="payment_method" class="form-control" id="paymentMethodChange">
                                    <option value="">{{ SELECT_PAYMENT_METHOD }}</option>
                                    <option value="PayPal">{{ PAYPAL }}</option>
                                    <option value="Stripe">{{ STRIPE }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="paypal mt_20">
                        <h4>{{ PAY_WITH_PAYPAL }}</h4>
                        <form action="{{ route('customer.paypal') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ PAY_WITH_PAYPAL }}
                            </button>
                        </form>
                    </div>

                    <div class="stripe mt_20">
                        <h4>{{ PAY_WITH_STRIPE }}</h4>
                        <form action="{{ route('customer.stripe') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ PAY_WITH_STRIPE }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection