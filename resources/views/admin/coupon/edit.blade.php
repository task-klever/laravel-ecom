@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Coupon</h1>

    <div class="row">
        <div class="col-md-6">
            <form action="{{ url('admin/coupon/update/'.$coupon->id) }}" method="post">
                @csrf
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Coupon</h6>
                        <div class="float-right d-inline">
                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Coupon Code *</label>
                                    <input type="text" name="coupon_code" class="form-control" value="{{ $coupon->coupon_code }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Type *</label>
                                    <select name="coupon_type" class="form-control">
                                        <option value="Percentage" @if($coupon->coupon_type == 'Percentage') selected @endif>Percentage</option>
                                        <option value="Amount" @if($coupon->coupon_type == 'Amount') selected @endif>Amount</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Discount *</label>
                                    <input type="text" name="coupon_discount" class="form-control" value="{{ $coupon->coupon_discount }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Maximum Use *</label>
                                    <input type="text" name="coupon_maximum_use" class="form-control" value="{{ $coupon->coupon_maximum_use }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Start Date *</label>
                                    <input id="datepicker" type="text" name="coupon_start_date" class="form-control" value="{{ $coupon->coupon_start_date }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon End Date *</label>
                                    <input id="datepicker1" type="text" name="coupon_end_date" class="form-control" value="{{ $coupon->coupon_end_date }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Status *</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="coupon_status" id="rr1" value="Show" @if($coupon->coupon_status == 'Show') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr1">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="coupon_status" id="rr2" value="Hide" @if($coupon->coupon_status == 'Hide') checked @endif>
                                            <label class="form-check-label font-weight-normal" for="rr2">Hide</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
