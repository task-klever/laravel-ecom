@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Job</h1>

    <form action="{{ route('admin.job.store') }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Add Job</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.job.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Title *</label>
                    <input type="text" name="job_title" class="form-control" value="{{ old('job_title') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" name="job_slug" class="form-control" value="{{ old('job_slug') }}">
                </div>
                <div class="form-group">
                    <label for="">Short Description *</label>
                    <textarea name="job_description_short" class="form-control h_100" cols="30" rows="10">{{ old('job_description_short') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Responsibility *</label>
                    <textarea name="job_responsibility" class="form-control editor" cols="30" rows="10">{{ old('job_responsibility') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Education</label>
                    <textarea name="job_education" class="form-control editor" cols="30" rows="10">{{ old('job_education') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Experience</label>
                    <textarea name="job_experience" class="form-control editor" cols="30" rows="10">{{ old('job_experience') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Additional Requirement</label>
                    <textarea name="job_additional_requirement" class="form-control editor" cols="30" rows="10">{{ old('job_additional_requirement') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Benefit</label>
                    <textarea name="job_benefit" class="form-control editor" cols="30" rows="10">{{ old('job_benefit') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Deadline *</label>
                    <input id="datepicker" type="text" name="job_deadline" class="form-control" value="{{ old('job_deadline') }}">
                </div>
                <div class="form-group">
                    <label for="">Vacancy *</label>
                    <input type="text" name="job_vacancy" class="form-control" value="{{ old('job_vacancy') }}">
                </div>
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" name="job_company_name" class="form-control" value="{{ old('job_company_name') }}">
                </div>
                <div class="form-group">
                    <label for="">Location *</label>
                    <input type="text" name="job_location" class="form-control" value="{{ old('job_location') }}">
                </div>
                <div class="form-group">
                    <label for="">Job Type *</label>
                    <select name="job_type" class="form-control">
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Salary *</label>
                    <input type="text" name="job_salary" class="form-control" value="{{ old('job_salary') }}">
                </div>
                <div class="form-group">
                    <label for="">Order</label>
                    <input type="text" name="job_order" class="form-control" value="{{ old('job_order') }}">
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
