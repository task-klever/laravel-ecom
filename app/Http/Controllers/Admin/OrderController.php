<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view('admin.order.index', compact('order'));
    }

    public function detail($id)
    {
        $order_detail = DB::table('orders')->where('id',$id)->first();
        $product_list = DB::table('order_details')->where('order_id',$id)->get();
        return view('admin.order.detail', compact('order_detail','product_list'));
    }

    public function invoice($id)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $order_detail = DB::table('orders')->where('id',$id)->first();
        $product_list = DB::table('order_details')->where('order_id',$id)->get();
        return view('admin.order.invoice', compact('order_detail','product_list','g_setting'));
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        DB::table('orders')->where('id', $id)->delete();
        DB::table('order_details')->where('order_id', $id)->delete();

        return Redirect()->back()->with('success', 'Order is deleted successfully!');
    }
}
