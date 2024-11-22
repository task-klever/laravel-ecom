<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::all();
        return view('admin.coupon.index', compact('coupon'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $coupon = new Coupon();
        $data = $request->only($coupon->getFillable());

        $request->validate([
            'coupon_code' => 'required|unique:coupons',
            'coupon_type' => 'required',
            'coupon_discount' => 'required',
            'coupon_maximum_use' => 'required',
            'coupon_start_date' => 'required',
            'coupon_end_date' => 'required',
            'coupon_status' => 'required'
        ]);
        $data['coupon_existing_use'] = 0;

        $coupon->fill($data)->save();
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon is added successfully!');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $coupon = Coupon::findOrFail($id);
        $data = $request->only($coupon->getFillable());

        $request->validate([
            'coupon_code' => [
                'required',
                Rule::unique('coupons')->ignore($id),
            ],
            'coupon_type' => 'required',
            'coupon_discount' => 'required',
            'coupon_maximum_use' => 'required',
            'coupon_start_date' => 'required',
            'coupon_end_date' => 'required',
            'coupon_status' => 'required'
        ]);

        $coupon->fill($data)->save();
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon is updated successfully!');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return Redirect()->back()->with('success', 'Coupon is deleted successfully!');
    }
}
