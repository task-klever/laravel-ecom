@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Front End Text</h1>

    <form action="{{ url('admin/translation/front/update/') }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Front End Text</h6>
                <div class="float-right d-inline">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($language_data as $key=>$value)
                            <input type="hidden" class="form-control" name="key_arr[]" value="{{ $key }}">
                            <tr>
                                <td>
                                    <input type="text" name="" class="form-control" value="{{ $key }}" disabled>
                                </td>
                                <td>
                                    <input type="text" name="value_arr[]" class="form-control" value="{{ $value }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>

@endsection
