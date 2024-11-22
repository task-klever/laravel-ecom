@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Order Detail</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">Order Details</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Order Number</td>
                                <td>{{ $order_detail->order_no }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Cost</td>
                                <td>{{ $order_detail->shipping_cost }}</td>
                            </tr>
                            <tr>
                                <td>Coupon Discount</td>
                                <td>${{ $order_detail->coupon_discount }} (CODE: {{ $order_detail->coupon_code }})</td>
                            </tr>
                            <tr>
                                <td>Paid Amount</td>
                                <td>${{ $order_detail->paid_amount }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">Customer & Payment Gateway Details</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Customer Type</td>
                                <td>{{ $order_detail->customer_type }}</td>
                            </tr>
                            <tr>
                                <td>Customer Name</td>
                                <td>{{ $order_detail->customer_name }}</td>
                            </tr>
                            <tr>
                                <td>Customer Email</td>
                                <td>{{ $order_detail->customer_email }}</td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td>
                                    {{ $order_detail->payment_method }}
                                    @if($order_detail->payment_method == 'Stripe')
                                        <br>
                                        Card Last 4 Digit: {{ $order_detail->card_last4 }}
                                        <br>
                                        Expiry Month: {{ $order_detail->card_exp_month }}
                                        <br>
                                        Expiry Year: {{ $order_detail->card_exp_year }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Date & Time</td>
                                <td>{{ $order_detail->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>{{ $order_detail->payment_status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">Billing Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Billing Name</td>
                                <td>{{ $order_detail->billing_name }}</td>
                            </tr>
                            <tr>
                                <td>Billing Email</td>
                                <td>{{ $order_detail->billing_email }}</td>
                            </tr>
                            <tr>
                                <td>Billing Phone</td>
                                <td>{{ $order_detail->billing_phone }}</td>
                            </tr>
                            <tr>
                                <td>Billing Country</td>
                                <td>{{ $order_detail->billing_country }}</td>
                            </tr>
                            <tr>
                                <td>Billing Address</td>
                                <td>{{ $order_detail->billing_address }}</td>
                            </tr>
                            <tr>
                                <td>Billing State</td>
                                <td>{{ $order_detail->billing_state }}</td>
                            </tr>
                            <tr>
                                <td>Billing City</td>
                                <td>{{ $order_detail->billing_city }}</td>
                            </tr>
                            <tr>
                                <td>Billing Zip</td>
                                <td>{{ $order_detail->billing_zip }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">Shipping Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Shipping Name</td>
                                <td>{{ $order_detail->shipping_name }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Email</td>
                                <td>{{ $order_detail->shipping_email }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Phone</td>
                                <td>{{ $order_detail->shipping_phone }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Country</td>
                                <td>{{ $order_detail->shipping_country }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Address</td>
                                <td>{{ $order_detail->shipping_address }}</td>
                            </tr>
                            <tr>
                                <td>Shipping State</td>
                                <td>{{ $order_detail->shipping_state }}</td>
                            </tr>
                            <tr>
                                <td>Shipping City</td>
                                <td>{{ $order_detail->shipping_city }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Zip</td>
                                <td>{{ $order_detail->shipping_zip }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">Product Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Product Subtotal</th>
                            </tr>
                            @foreach($product_list as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->product_name }}</td>
                                <td>${{ $row->product_price }}</td>
                                <td>{{ $row->product_qty }}</td>
                                <td>${{ $row->product_price * $row->product_qty }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
