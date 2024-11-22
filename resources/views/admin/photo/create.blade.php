@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Photo</h1>

    <form action="{{ route('admin.photo.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Add Photo</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.photo.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Photo *</label>
                    <div>
                        <input type="file" name="photo_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Caption</label>
                            <input type="text" name="photo_caption" class="form-control" value="{{ old('photo_caption') }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Order</label>
                            <input type="text" name="photo_order" class="form-control" value="{{ old('photo_order', '0') }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>

@endsection
