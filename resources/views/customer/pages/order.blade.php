@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_customer_panel) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Orders</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                    <div class="table-responsive-md">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">Serial</th>
                                    <th scope="col">Order Number</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Payment Date and Time</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $order_data = DB::table('orders')->orderBy('id','desc')->where('customer_id', Auth::guard('customer')->user()->id)->get();
                                    $i=0;
                                @endphp

                                @foreach($order_data as $row)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $row->order_no }}</td>
                                        <td>{{ $row->payment_method }}</td>
                                        <td>
                                            ${{ number_format((float)$row->paid_amount, 2, '.', '') }}
                                        </td>
                                        <td>
                                            <b>Date:</b><br>{{ \Carbon\Carbon::parse($row->created_at)->format('d M, Y') }}<br>
                                            <b>Time:</b><br>{{ \Carbon\Carbon::parse($row->created_at)->format('h:i:s A') }}
                                        </td>
                                        <td>
                                            @if($row->payment_status == 'Completed')
                                                <a href="javascript:void;" class="btn btn-success btn-sm">{{ $row->payment_status }}</a>
                                            @else
                                                <a href="javascript:void;" class="btn btn-danger btn-sm">{{ $row->payment_status }}</a>
                                            @endif
                                        </td>
                                        <td>
<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
</button>
<div class="dropdown-menu dropdown-menu-right">
    <a href="" class="dropdown-item" data-toggle="modal" data-target="#modd{{ $i }}"><i class="fa fa-eye"></i> Details</a>
</div>										
<div class="modal fade" id="modd{{ $i }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold mb_0" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="font-weight-bold mb_5">Order Details</h6>
                <div class="table-responsive">
                    <table class="table table-sm w-100-p">
                        <tr>
                            <td class="alert-warning w-200">Order Number</td>
                            <td>{{ $row->order_no }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Payment Date Time</td>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Shipping Cost</td>
                            <td>${{ number_format((float)$row->shipping_cost, 2, '.', '') }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Coupon Code</td>
                            <td>{{ $row->coupon_code }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Coupon Discount</td>
                            <td>${{ number_format((float)$row->coupon_discount, 2, '.', '') }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Paid Amount</td>
                            <td>${{ number_format((float)$row->paid_amount, 2, '.', '') }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Payment Status</td>
                            <td>
                                @if($row->payment_status == 'Completed')
                                    <a href="javascript:void;" class="btn btn-success btn-sm">{{ $row->payment_status }}</a>
                                @else
                                    <a href="javascript:void;" class="btn btn-danger btn-sm">{{ $row->payment_status }}</a>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <h6 class="font-weight-bold mt_20 mb_5">Customer & Payment Gateway Details</h6>
                <div class="table-responsive">
                    <table class="table table-sm w-100-p">
                        <tr>
                            <td class="alert-warning w-200">Customer Type</td>
                            <td>{{ $row->customer_type }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning w_150">Customer Name</td>
                            <td>{{ $row->customer_name }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Customer Email</td>
                            <td>{{ $row->customer_email }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Payment Method</td>
                            <td>{{ $row->payment_method }}</td>
                        </tr>

                        @if($row->payment_method == 'Stripe')
                        <tr>
                            <td class="alert-warning">Card Last 4 Digits</td>
                            <td>{{ $row->card_last4 }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Expiry Month</td>
                            <td>{{ $row->card_exp_month }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Expiry Year</td>
                            <td>{{ $row->card_exp_year }}</td>
                        </tr>
                        @endif

                    </table>
                </div>


                <h6 class="font-weight-bold mt_20 mb_5">Billing Information</h6>
                <div class="table-responsive">
                    <table class="table table-sm w-100-p">
                        <tr>
                            <td class="alert-warning w-200">Name</td>
                            <td>{{ $row->billing_name }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Email</td>
                            <td>{{ $row->billing_email }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Phone</td>
                            <td>{{ $row->billing_phone }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Country</td>
                            <td>{{ $row->billing_country }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Address</td>
                            <td>{{ $row->billing_address }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">State</td>
                            <td>{{ $row->billing_state }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">City</td>
                            <td>{{ $row->billing_city }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Zip Code</td>
                            <td>{{ $row->billing_zip }}</td>
                        </tr>
                    </table>
                </div>



                <h6 class="font-weight-bold mt_20 mb_5">Shipping Information</h6>
                <div class="table-responsive">
                    <table class="table table-sm w-100-p">
                        <tr>
                            <td class="alert-warning w-200">Name</td>
                            <td>{{ $row->shipping_name }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Email</td>
                            <td>{{ $row->shipping_email }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Phone</td>
                            <td>{{ $row->shipping_phone }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Country</td>
                            <td>{{ $row->shipping_country }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Address</td>
                            <td>{{ $row->shipping_address }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">State</td>
                            <td>{{ $row->shipping_state }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">City</td>
                            <td>{{ $row->shipping_city }}</td>
                        </tr>
                        <tr>
                            <td class="alert-warning">Zip Code</td>
                            <td>{{ $row->shipping_zip }}</td>
                        </tr>
                    </table>
                </div>


                <h6 class="font-weight-bold mt_20 mb_5">Product Information</h6>
                <div class="table-responsive">
                    <table class="table table-sm w-100-p">
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        @php
                            $order_detail_data = DB::table('order_details')->where('order_id', $row->id)->get();
                            $j=0;
                        @endphp
                        
                        @foreach ($order_detail_data as $row1)
                            @php
                                $j++;
                            @endphp
                            <tr>
                                <td>{{ $j }}</td>
                                <td>{{ $row1->product_name }}</td>
                                <td>${{ number_format((float)$row1->product_price, 2, '.', '') }}</td>
                                <td>{{ $row1->product_qty }}</td>
                                <td>
                                    @php
                                        $s_total = $row1->product_price*$row1->product_qty;
                                    @endphp
                                    {{ '$'.number_format((float)$s_total, 2, '.', '') }}
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
