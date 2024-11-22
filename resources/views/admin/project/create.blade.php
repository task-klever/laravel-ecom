@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Project</h1>

    <form action="{{ route('admin.project.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Add Project</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.project.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name *</label>
                    <input type="text" name="project_name" class="form-control" value="{{ old('project_name') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" name="project_slug" class="form-control" value="{{ old('project_slug') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea name="project_content" class="form-control editor" cols="30" rows="10">{{ old('project_content') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Content (Short)</label>
                    <textarea name="project_content_short" class="form-control h_100" cols="30" rows="10">{{ old('project_content_short') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Project Start Date</label>
                    <input type="text" name="project_start_date" class="form-control" value="{{ old('project_start_date') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Project End Date</label>
                    <input type="text" name="project_end_date" class="form-control" value="{{ old('project_end_date') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Client Name</label>
                    <input type="text" name="project_client_name" class="form-control" value="{{ old('project_client_name') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Client Company</label>
                    <input type="text" name="project_client_company" class="form-control" value="{{ old('project_client_company') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Client Company</label>
                    <textarea name="project_client_comment" class="form-control h_100" cols="30" rows="10">{{ old('project_client_comment') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Video (YouTube ID)</label>
                    <input type="text" name="project_video" class="form-control" value="{{ old('project_video') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Featured Photo *</label>
                    <div>
                        <input type="file" name="project_featured_photo">
                    </div>
                </div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Information</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title') }}">
                </div>
                <div class="form-group">
                    <label for="">Meta Description</label>
                    <textarea name="seo_meta_description" class="form-control h_100" cols="30" rows="10">{{ old('seo_meta_description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
@endsection