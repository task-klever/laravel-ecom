<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class ShippingController extends Controller
{
    public function index()
    {
        $shipping = Shipping::orderBy('shipping_order', 'asc')->get();
        return view('admin.shipping.index', compact('shipping'));
    }

    public function create()
    {
        return view('admin.shipping.create');
    }

    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $shipping = new Shipping();
        $data = $request->only($shipping->getFillable());

        $request->validate([
            'shipping_name' => 'required|unique:shippings',
            'shipping_text' => 'required',
            'shipping_cost' => 'required|numeric|max:10000',
            'shipping_status' => 'required'
        ]);

        $shipping->fill($data)->save();
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping is added successfully!');
    }

    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        return view('admin.shipping.edit', compact('shipping'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $shipping = Shipping::findOrFail($id);
        $data = $request->only($shipping->getFillable());

        $request->validate([
            'shipping_name' => [
                'required',
                Rule::unique('shippings')->ignore($id),
            ],
            'shipping_text' => 'required',
            'shipping_cost' => 'required|numeric|max:10000',
            'shipping_status' => 'required'
        ]);

        $shipping->fill($data)->save();
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping is updated successfully!');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $shipping = Shipping::findOrFail($id);
        $shipping->delete();
        return Redirect()->back()->with('success', 'Shipping is deleted successfully!');
    }
}
