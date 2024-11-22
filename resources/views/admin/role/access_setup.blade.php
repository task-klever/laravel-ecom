@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Setup Roles for {{ $role->role_name }}</h1>

    <form action="{{ url('admin/role/access-setup-update/'.$role->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 mt-2 font-weight-bold text-primary">Setup Roles for {{ $role->role_name }}</h6>
                        <div class="float-right d-inline">
                            <a href="{{ route('admin.role.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">

                        @php $i=0; @endphp
                        @foreach($role_permissions as $row)
                            <input type="hidden" name="role_permission_ids[@php echo $i; @endphp]" value="{{ $row->id }}">
                            <input type="hidden" name="access_status_arr[@php echo $i; @endphp]" value="0">

                            <tr>
                                <td class="w_50">
                                    <input type="checkbox" name="access_status_arr[@php echo $i; @endphp]" value="1" @if($row->access_status == 1) @php echo 'checked'; @endphp @endif>
                                </td>
                                <td>
                                    @php
                                        $role_page_data = DB::table('role_pages')->where('id', $row->role_page_id)->first();
                                    @endphp

                                    {{ $role_page_data->page_title }}
                                </td>
                            </tr>
                            @php $i++; @endphp

                        @endforeach

                        </table>

                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
