@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Admin User</h1>

    <form action="{{ route('admin.role.user-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 mt-2 font-weight-bold text-primary">Add Admin User</h6>
                        <div class="float-right d-inline">
                            <a href="{{ route('admin.role.user') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Photo *</label>
                            <div>
                                <input type="file" name="photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Password *</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Retype Password *</label>
                            <input type="password" name="re_password" class="form-control" value="{{ old('re_password') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Select Role *</label>
                            <select name="role_id" class="form-control">
                                @foreach($roles as $row)
                                    @if($row->role_name == 'Super Admin')
                                        @continue
                                    @endif
                                    <option value="{{ $row->id }}">{{ $row->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-body">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
