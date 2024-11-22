@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800 invoice-heading">Order Invoice</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary invoice-heading">Order Invoice</h6>
                </div>
                <div class="card-body">
                    <div class="invoice-area">
                        <div class="invoice-head">
                            <div class="row">
                                <div class="iv-left col-5">
                                    <span>
                                        <img src="{{ asset('uploads/'.$g_setting->logo) }}" alt="" class="h_70">
                                    </span>
                                </div>
                                <div class="iv-right col-7 text-md-right">
                                    <div>
                                        <span>
                                            Invoice No: {{ $order_detail->order_no }}</span>
                                        <div class="mt_10">
                                            <a href="javascript:window.print();" class="btn btn-info btn-sm mr_5 print-invoice-button">Print Invoice</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="invoice-address">
                                    <h5>Invoiced To</h5>
                                    <p>Name: {{ $order_detail->customer_name }}</p>
                                    <p>Email: {{ $order_detail->customer_name }}</p>
                                    <p>Payment Method: {{ $order_detail->payment_method }}</p>
                                    <p>Payment Status: {{ $order_detail->payment_status }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="invoice-address">
                                    <h5>Billing Info</h5>
                                    <p>Name: {{ $order_detail->billing_name }}</p>
                                    <p>Email: {{ $order_detail->billing_email }}</p>
                                    <p>Phone: {{ $order_detail->billing_phone }}</p>
                                    <p>Country: {{ $order_detail->billing_country }}</p>
                                    <p>Address: {{ $order_detail->billing_address }}</p>
                                    <p>State: {{ $order_detail->billing_state }}</p>
                                    <p>City: {{ $order_detail->billing_city }}</p>
                                    <p>Zip Code: {{ $order_detail->billing_zip }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="invoice-address">
                                    <h5>Shipping Info</h5>
                                    <p>Name: {{ $order_detail->shipping_name }}</p>
                                    <p>Email: {{ $order_detail->shipping_email }}</p>
                                    <p>Phone: {{ $order_detail->shipping_phone }}</p>
                                    <p>Country: {{ $order_detail->shipping_country }}</p>
                                    <p>Address: {{ $order_detail->shipping_address }}</p>
                                    <p>State: {{ $order_detail->shipping_state }}</p>
                                    <p>City: {{ $order_detail->shipping_city }}</p>
                                    <p>Zip Code: {{ $order_detail->shipping_zip }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-right">
                                <ul class="invoice-address">
                                    <h5>Invoice Date & Time</h5>
                                    <p>
                                        Date: 
                                        {{ \Carbon\Carbon::parse($order_detail->created_at)->format('d M, Y') }}
                                    </p>
                                    <p>
                                        Time: 
                                        {{ \Carbon\Carbon::parse($order_detail->created_at)->format('H:i:s A') }}
                                    </p>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-address mt-5">
                                    <h5>Product Details</h5>
                                </div>
                                <div class="table-responsive invoice-table">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-right">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total=0;  @endphp
                                            @foreach($product_list as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $row->product_name }}</td>
                                                    <td>${{ $row->product_price }}</td>
                                                    <td>{{ $row->product_qty }}</td>
                                                    @php
                                                        $subtotal = $row->product_price * $row->product_qty;
                                                    @endphp
                                                    <td class="text-right">${{ $subtotal }}</td>
                                                </tr>
                                                @php
                                                    $total = $total + $subtotal;
                                                @endphp
                                            @endforeach 
                                        </tbody>
                                        <tfoot class="text-right">
                                            <tr>
                                                <td colspan="4">Total Price: </td>
                                                <td>${{ $total }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Shipping Cost: </td>
                                                <td>+${{ $order_detail->shipping_cost }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Coupon Discount: </td>
                                                <td>-${{ $order_detail->coupon_discount }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Final Price: </td>
                                                <td>${{ ($total+$order_detail->shipping_cost)-$order_detail->coupon_discount }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
