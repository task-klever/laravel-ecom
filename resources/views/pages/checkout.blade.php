@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_checkout) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ CHECKOUT }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ CHECKOUT }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content pt_50 pb_60">
        <div class="container">
            <div class="row cart">
                <div class="col-md-12 faq">
                    
                    
                    <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading1">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                        {{ HAVE_COUPON }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <form action="{{ route('front.coupon_update') }}" method="post">
                                            @csrf
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left pr-1">
                                                            <input type="text" class="form-control" placeholder="{{ COUPON_CODE }}" name="coupon_code">
                                                        </td>
                                                        <td class="text-left">
                                                            <button type="submit" class="btn btn-primary btn-block">{{ APPLY_COUPON }}</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading2">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        {{ SHIPPING_INFORMATION }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="text-left table-top-bottom-no-border">
                                                        <form action="{{ route('front.shipping_update') }}" method="post">
                                                            @csrf
                                                            @php $i=0;  @endphp
                                                            @foreach($shipping_data as $row)
                                                                @php $i++;  @endphp
                                                                @if( !session()->get('shipping_id') )
                                                                    @if($i==1)
                                                                        @php $chk='checked'; @endphp
                                                                    @else
                                                                        @php $chk=''; @endphp
                                                                    @endif
                                                                @else
                                                                    @if(session()->get('shipping_id') == $row->id)
                                                                    
                                                                        @php $chk='checked'; @endphp
                                                                    
                                                                    @else
                                                                        @php $chk=''; @endphp
                                                                    @endif
                                                                @endif

                                                                <div class="shipping-checkbox-container">
                                                                    <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="shipping_id" id="shipping_radio_{{ $i }}" value="{{ $row->id }}" {{ $chk }}>
                                                                        <label class="form-check-label" for="shipping_radio_{{ $i }}">
                                                                            <div class="heading">
                                                                                {{ $row->shipping_name }}
                                                                                ($<span class="shipping_price">{{ $row->shipping_cost }})</span>
                                                                            </div>
                                                                            <div class="subheading">({!! nl2br(e($row->shipping_text)) !!})</div>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                            <input type="submit" class="btn btn-primary" value="{{ APPLY_SHIPPING }}">
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        



                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading3">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        {{ CART_DETAIL }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                @php
                                                    $arr_cart_product_id = array();
                                                    $arr_cart_product_qty = array();
                                                @endphp
                                                
                                                @php $i=0; @endphp
                                                @foreach(session()->get('cart_product_id') as $value)
                                                    @php 
                                                        $arr_cart_product_id[$i] = $value;
                                                        $i++;
                                                    @endphp
                                                @endforeach
                    
                                                @php $i=0; @endphp
                                                @foreach(session()->get('cart_product_qty') as $value)
                                                    @php
                                                        $arr_cart_product_qty[$i] = $value;
                                                        $i++;
                                                    @endphp
                                                @endforeach
                    
                                                @php $tot1 = 0; @endphp
                                                
                                                @for($i=0;$i<count($arr_cart_product_id);$i++)
                
                                                    @php
                                                        $product_detail = DB::table('products')->where('id', $arr_cart_product_id[$i])->first();
                                                        $product_name = $product_detail->product_name;
                                                        $product_slug = $product_detail->product_slug;
                                                        $product_current_price = $product_detail->product_current_price;
                                                        $product_featured_photo = $product_detail->product_featured_photo;
                                                    @endphp
                
                                                    <tr>
                                                        <td class="text-left">
                                                            {{ $product_name }} x {{ $arr_cart_product_qty[$i] }}
                                                        </td>
                                                        <td class="text-right">
                                                            @php $subtotal = $product_current_price * $arr_cart_product_qty[$i] @endphp
                                                            ${{ $subtotal }}
                                                        </td>
                                                    </tr>
                                                    
                                                    @php
                                                        $tot1 = $tot1+$subtotal; 
                                                    @endphp
                                                    
                                                @endfor
                
                                                @php 
                                                    session()->put('subtotal', $tot1);
                                                @endphp
                                                
                                                <tr>
                                                    <td class="text-left">{{ SUB_TOTAL }} </td>
                                                    <td class="text-right">
                                                        $<span class="subtotal_price">{{ session()->get('subtotal') }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">
                                                        {{ COUPON }} <span class="font-weight-bold">@if(session()->get('coupon_code')) {{ '('.session()->get('coupon_code').')' }} @endif</span>
                                                    </td>
                                                    <td class="text-right">
                                                        @if(session()->get('coupon_amount'))
                                                            (-) $<span class="coupon_amount">{{ session()->get('coupon_amount') }}</span>
                                                        @else
                                                            @php session()->put('coupon_amount', 0); @endphp
                                                            (-) $<span class="coupon_amount">{{ session()->get('coupon_amount') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                
                                                @if(session()->get('shipping_id'))
                                                <tr>
                                                    @php
                                                        $shipping_info = DB::table('shippings')->where('id', session()->get('shipping_id'))->first();
                                                    @endphp
                
                                                    <td class="text-left">
                                                        {{ SHIPPING_INFORMATION }} <br>(<span class="font-weight-bold">{{ $shipping_info->shipping_name }} - {{ $shipping_info->shipping_text }}</span>)
                                                    </td>
                                                    <td class="text-right">
                                                        (+) $<span class="">{{ session()->get('shipping_cost') }}</span>
                                                    </td>
                                                </tr>
                                                @endif
                    
                                                <tr>
                                                    <td class="text-left">{{ TOTAL }} </td>
                                                    <td class="text-right">
                                                        
                                                        @if(!session()->get('coupon_amount'))
                                                            @php session()->put('coupon_amount', 0) @endphp
                                                        @endif
                                                        
                                                        @if(session()->get('shipping_cost'))
                                                            @php 
                                                                $final_price = (session()->get('subtotal') + session()->get('shipping_cost'))-session()->get('coupon_amount'); 
                                                            @endphp
                                                        @else
                                                            @php
                                                                $final_price =session()->get('subtotal') - session()->get('coupon_amount');
                                                            @endphp
                                                        @endif
                                                       
                                                        $<span class="total_price">{{ $final_price }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                    
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- //panel-group -->


                    @if(!Auth::guard('customer')->user())
                    <form action="{{ route('customer.login_from_checkout_page.store') }}" method="post">
                        @csrf
                        <div class="customer-info mb_30">
                            <div class="form-check mt_10 mb_10">
                                <input class="form-check-input" type="checkbox" id="returning_customer_action">
                                <label class="form-check-label" for="returning_customer_action">
                                    {{ RETURNING_CUSTOMER_CLICK_TO_LOGIN }}
                                </label>
                            </div>
                            <div class="returning-customer-login-section d_n">
                                <h4>{{ LOGIN }}</h4>
                                <div class="row mb_10">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="{{ EMAIL_ADDRESS }}" name="email">
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" placeholder="{{ PASSWORD }}" name="password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ LOGIN }}</button>
                            </div>
                        </div>
                    </form>
                    @endif

                    @if(Auth::guard('customer')->user())
                    <div class="existing-customer-container">
                        <h4>{{ EXISTING_CUSTOMER }}</h4>
                        <div class="row mb_30">
                            <div class="col">
                                <input type="text" class="form-control first_field" value="{{ Auth::guard('customer')->user()->name }}" disabled>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control second_field" value="{{ Auth::guard('customer')->user()->email }}" disabled>
                            </div>
                        </div>      
                    </div>
                    @endif

                    @php $temp_var = '';  @endphp
                    <form action="{{ route('customer.billing_shipping_submit') }}" method="post">
                        @csrf
                        <h4>{{ BILLING_INFORMATION }}</h4>
                        <div class="row mb_10">
                            <div class="col">
                                @if(session()->get('billing_name'))
                                @php $temp_var = session()->get('billing_name') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->name @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ FULL_NAME }}" name="billing_name" value="{{ $temp_var }}">
                            </div>
                            <div class="col">
                                @if(session()->get('billing_email'))
                                @php $temp_var = session()->get('billing_email') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->email @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ EMAIL_ADDRESS }}" name="billing_email" value="{{ $temp_var }}">
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                @if(session()->get('billing_phone'))
                                @php $temp_var = session()->get('billing_phone') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->phone @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ PHONE }}" name="billing_phone" value="{{ $temp_var }}">
                            </div>
                            <div class="col">
                                @if(session()->get('billing_country'))
                                @php $temp_var = session()->get('billing_country') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->country @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ COUNTRY }}" name="billing_country" value="{{ $temp_var }}">
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                @if(session()->get('billing_address'))
                                @php $temp_var = session()->get('billing_address') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->address @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ ADDRESS }}" name="billing_address" value="{{ $temp_var }}">
                            </div>
                            <div class="col">
                                @if(session()->get('billing_state'))
                                @php $temp_var = session()->get('billing_state') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->state @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ STATE }}" name="billing_state" value="{{ $temp_var }}">
                            </div>
                        </div>
                        <div class="row mb_10">
                            <div class="col">
                                @if(session()->get('billing_city'))
                                @php $temp_var = session()->get('billing_city') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->city @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ CITY }}" name="billing_city" value="{{ $temp_var }}">
                            </div>
                            <div class="col">
                                @if(session()->get('billing_zip'))
                                @php $temp_var = session()->get('billing_zip') @endphp
                                @elseif(Auth::guard('customer')->user())
                                @php $temp_var = Auth::guard('customer')->user()->zip @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="{{ ZIP_CODE }}" name="billing_zip" value="{{ $temp_var }}">
                            </div>
                        </div>
                        <div class="form-check mt_30 mb_10">
                            <input class="form-check-input" type="checkbox" id="click_shipping_same_check" name="name_click_shipping_same_check" @if(session()->get('name_click_shipping_same_check')) checked  @endif>
                            <label class="form-check-label" for="click_shipping_same_check">
                                {{ SHIP_TO_DIFFERENT_ADDRESS }}
                            </label>
                        </div>


                        <div class="shipping-info mt_15 @if(session()->get('name_click_shipping_same_check')) d_b @else d_n @endif">
                            <h4>{{ SHIPPING_INFORMATION }}</h4>
                            <div class="row mb_10">
                                <div class="col">
                                    @if(session()->get('shipping_name'))
                                    @php $temp_var = session()->get('shipping_name') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->name @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ FULL_NAME }}" name="shipping_name" value="{{ $temp_var }}">
                                </div>
                                <div class="col">
                                    @if(session()->get('shipping_email'))
                                    @php $temp_var = session()->get('shipping_email') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->email @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ EMAIL_ADDRESS }}" name="shipping_email" value="{{ $temp_var }}">
                                </div>
                            </div>
                            <div class="row mb_10">
                                <div class="col">
                                    @if(session()->get('shipping_phone'))
                                    @php $temp_var = session()->get('shipping_phone') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->phone @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ PHONE }}" name="shipping_phone" value="{{ $temp_var }}">
                                </div>
                                <div class="col">
                                    @if(session()->get('shipping_country'))
                                    @php $temp_var = session()->get('shipping_country') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->country @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ COUNTRY }}" name="shipping_country" value="{{ $temp_var }}">
                                </div>
                            </div>
                            <div class="row mb_10">
                                <div class="col">
                                    @if(session()->get('shipping_address'))
                                    @php $temp_var = session()->get('shipping_address') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->address @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ ADDRESS }}" name="shipping_address" value="{{ $temp_var }}">
                                </div>
                                <div class="col">
                                    @if(session()->get('shipping_state'))
                                    @php $temp_var = session()->get('shipping_state') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->state @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ STATE }}" name="shipping_state" value="{{ $temp_var }}">
                                </div>
                            </div>
                            <div class="row mb_10">
                                <div class="col">
                                    @if(session()->get('shipping_city'))
                                    @php $temp_var = session()->get('shipping_city') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->city @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ CITY }}" name="shipping_city" value="{{ $temp_var }}">
                                </div>
                                <div class="col">
                                    @if(session()->get('shipping_zip'))
                                    @php $temp_var = session()->get('shipping_zip') @endphp
                                    @elseif(Auth::guard('customer')->user())
                                    @php $temp_var = Auth::guard('customer')->user()->zip @endphp
                                    @endif
                                    <input type="text" class="form-control" placeholder="{{ ZIP_CODE }}" name="shipping_zip" value="{{ $temp_var }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb_10">
                            <div class="col">
                                @if(session()->get('order_note'))
                                @php $temp_var = session()->get('order_note') @endphp
                                @else
                                @php $temp_var = '' @endphp
                                @endif
                                <textarea name="order_note" class="form-control h-100" cols="30" rows="10" placeholder="{{ ORDER_NOTE }}">{{ $temp_var }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ CONTINUE_TO_PAYMENT }}</button>
                    </form>





                </div>
            </div>
        </div>
    </div>

    <script>
        (function($) {
            
            "use strict";
            
            $(document).ready(function() {
                $("#click_shipping_same_check").on('change',function(e) {
                    e.preventDefault();
                    if($(this).prop("checked") == true){
                        $('.shipping-info').attr('class','shipping-info mt_15 d_b');
                    } else {
                        $('.shipping-info').attr('class','shipping-info mt_15 d_n');
                    }
                });
        
                $("#returning_customer_action").on('change',function(e) {
                    e.preventDefault();
                    if($(this).prop("checked") == true){
                        $('.returning-customer-login-section').attr('class','returning-customer-login-section d_b');
                    } else {
                        $('.returning-customer-login-section').attr('class','returning-customer-login-section d_n');
                    }
                });
                
                $("#coupon_parent").on('change',function(e) {
                    e.preventDefault();
                    if($(this).prop("checked") == true){
                        $('.coupon_child').attr('class','coupon_child d_b');
                    } else {
                        $('.coupon_child').attr('class','coupon_child d_n');
                    }
                });
            });
        
        })(jQuery);
        </script>
@endsection