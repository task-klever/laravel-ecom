@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Admin User</h1>

    <form action="{{ url('admin/role/user/update/'.$admin_user->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="current_photo" value="{{ $admin_user->photo }}">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Admin User</h6>
                        <div class="float-right d-inline">
                            <a href="{{ route('admin.role.user') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" name="name" class="form-control" value="{{ $admin_user->name }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ $admin_user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Existing Photo</label>
                            <div>
                                <img src="{{ asset('uploads/'.$admin_user->photo) }}" alt="" class="w_200">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Change Photo</label>
                            <div>
                                <input type="file" name="photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Select Role *</label>
                            <select name="role_id" class="form-control">
                                @foreach($roles as $row)
                                    @if($row->role_name == 'Super Admin')
                                        @continue
                                    @endif
                                    <option value="{{ $row->id }}" @if($row->id == $admin_user->role_id) selected @endif>{{ $row->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
