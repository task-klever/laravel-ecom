@extends('admin.admin_layouts')
@section('admin_content')

    @php
    $project_row = DB::table('projects')->where('id', $project_id)->first();
    @endphp

    <h1 class="h3 mb-3 text-gray-800">Gallery of {{ $project_row->project_name }}</h1>
    <form action="{{ route('admin.project.gallery-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="project_id" value="{{ $project_id }}">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Add Project Photo</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.project.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Back to Project Page</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Caption</label>
                    <input type="text" name="project_photo_caption" class="form-control" value="{{ old('project_photo_caption') }}">
                </div>
                <div class="form-group">
                    <label for="">Featured Photo *</label>
                    <div>
                        <input type="file" name="project_photo">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">All Existing Photos</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.project.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Back to Project Page</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Photo</th>
                        <th>Caption</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($project_photo as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('uploads/'.$row->project_photo) }}" alt="" class="w_200"></td>
                            <td>{{ $row->project_photo_caption }}</td>
                            <td>
                                <a href="{{ URL::to('admin/project/gallery-delete/'.$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
