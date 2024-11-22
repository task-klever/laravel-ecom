@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Admin User Password</h1>

    <form action="{{ url('admin/role/user/update/password/'.$admin_user->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Admin User Password</h6>
                        <div class="float-right d-inline">
                            <a href="{{ route('admin.role.user') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">New Password *</label>
                            <input type="password" name="password" class="form-control" value="" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Retype Password *</label>
                            <input type="password" name="re_password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
