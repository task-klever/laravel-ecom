@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Customer Detail</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">Customer Details</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Customer Name</td>
                                <td>{{ $customer_detail->name }}</td>
                            </tr>
                            <tr>
                                <td>Customer Email</td>
                                <td>{{ $customer_detail->email }}</td>
                            </tr>
                            <tr>
                                <td>Customer Phone</td>
                                <td>{{ $customer_detail->phone }}</td>
                            </tr>
                            <tr>
                                <td>Customer Country</td>
                                <td>{{ $customer_detail->country }}</td>
                            </tr>
                            <tr>
                                <td>Customer Address</td>
                                <td>{{ $customer_detail->address }}</td>
                            </tr>
                            <tr>
                                <td>Customer State</td>
                                <td>{{ $customer_detail->state }}</td>
                            </tr>
                            <tr>
                                <td>Customer City</td>
                                <td>{{ $customer_detail->city }}</td>
                            </tr>
                            <tr>
                                <td>Customer Zip</td>
                                <td>{{ $customer_detail->zip }}</td>
                            </tr>
                            <tr>
                                <td>Customer Status</td>
                                <td>{{ $customer_detail->status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection