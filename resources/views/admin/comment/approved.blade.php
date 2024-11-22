@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Approved Comments</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">View Approved Comments</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Person Name & Email</th>
                        <th>Person Message</th>
                        <th>Blog Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments_approved as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->person_name }} <br>{{ $row->person_email }}</td>
                            <td>{{ $row->person_message }}</td>
                            <td>
                                {{ $row->blog_title }}<br>
                                <a href="{{ url('blog/'.$row->blog_slug) }}" class="btn btn-primary btn-sm" target="_blank">See Blog</a>
                            </td>
                            <td>
                                <a href="{{ URL::to('admin/comment/make-pending/'.$row->id) }}" class="btn btn-warning btn-sm btn-block" onClick="return confirm('Are you sure?');">Make Pending</a>
                                <a href="{{ URL::to('admin/comment/delete/'.$row->id) }}" class="btn btn-danger btn-sm btn-block" onClick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
