@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Shippings</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">View Shippings</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.shipping.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Shipping Name</th>
                        <th>Shipping Text</th>
                        <th>Shipping Cost</th>
                        <th>Shipping Order</th>
                        <th>Shipping Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shipping as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->shipping_name }}</td>
                            <td>{{ $row->shipping_text }}</td>
                            <td>{{ $row->shipping_cost }}</td>
                            <td>{{ $row->shipping_order }}</td>
                            <td>{{ $row->shipping_status }}</td>
                            <td>
                                <a href="{{ URL::to('admin/shipping/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ URL::to('admin/shipping/delete/'.$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
