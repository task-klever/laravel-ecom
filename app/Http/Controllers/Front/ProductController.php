<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function index()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $shop = DB::table('page_shop_items')->where('id', 1)->first();
        $products = DB::table('products')->orderBy('product_order', 'asc')->where('product_status', 'Show')->paginate(12);

        return view('pages.shop', compact('shop','g_setting','products'));
    }

    public function detail($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $product_detail = DB::table('products')->where('product_slug', $slug)->first();
        if(!$product_detail) {
            return abort(404);
        }
        return view('pages.product_detail', compact('g_setting','product_detail'));
    }

    public function add_to_cart(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        $product_detail = DB::table('products')->where('id', $product_id)->first();

        // Check if items available in stock
        if($product_qty > $product_detail->product_stock)  {
            return redirect()->back()->with('error', 'Sorry! There are only '.$product_detail->product_stock.' item(s) in stock');
        }

        // Check if items already added to cart
        if(session()->has('cart_product_id'))
        {
            $arr_cart_product_id = array();
            $i=0;
            foreach(session()->get('cart_product_id') as $value) {
                $arr_cart_product_id[$i] = $value;
                $i++;
            }

            if(in_array($product_id,$arr_cart_product_id)) {
                return redirect()->back()->with('error', 'This product is already added to the shopping cart.');
            }
        }

        session()->push('cart_product_id', $product_id);
        session()->push('cart_product_qty', $product_qty);

        return redirect()->back()->with('success', 'Item is added to the cart successfully!');
    }

    public function cart()
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        return view('pages.cart', compact('g_setting'));
    }

    public function cart_item_delete($id)
    {
        $arr_cart_product_id = array();
        $arr_cart_product_qty = array();

        $i=0;
        foreach(session()->get('cart_product_id') as $value) {
            $arr_cart_product_id[$i] = $value;
            $i++;
        }

        $i=0;
        foreach(session()->get('cart_product_qty') as $value) {
            $arr_cart_product_qty[$i] = $value;
            $i++;
        }

        session()->forget('cart_product_id');
        session()->forget('cart_product_qty');

        for($i=0;$i<count($arr_cart_product_id);$i++)
        {
            if($arr_cart_product_id[$i] == $id)
            {
                continue;
            }
            else
            {
                session()->push('cart_product_id', $arr_cart_product_id[$i]);
                session()->push('cart_product_qty', $arr_cart_product_qty[$i]);
            }
        }

        return redirect()->back()->with('success', 'Item is deleted from the cart successfully!');
    }

    public function update_cart(Request $request)
    {
        $error_msg = 0;

        // Storing old data into array
        $old_cart_product_id = array();
        $old_cart_product_qty = array();

        $i=0;
        foreach(session()->get('cart_product_id') as $value) {
            $old_cart_product_id[$i] = $value;
            $i++;
        }

        $i=0;
        foreach(session()->get('cart_product_qty') as $value) {
            $old_cart_product_qty[$i] = $value;
            $i++;
        }

        // Removing old data from session
        session()->forget('cart_product_id');
        session()->forget('cart_product_qty');

        // Storing new data into array
        $new_cart_product_id = array();
        $new_cart_product_qty = array();

        $i=0;
        foreach($request->product_id as $value) {
            $new_cart_product_id[$i] = $value;
            $i++;
        }

        $i=0;
        foreach($request->product_qty as $value) {
            $new_cart_product_qty[$i] = $value;
            $i++;
        }

        for($i=0;$i<count($new_cart_product_id);$i++)
        {
            $product_detail = DB::table('products')->where('id', $new_cart_product_id[$i])->first();
            if($new_cart_product_qty[$i] > $product_detail->product_stock)
            {
                session()->push('cart_product_id', $new_cart_product_id[$i]);
                session()->push('cart_product_qty', $old_cart_product_qty[$i]);

                $error_msg = 1;
            }
            else
            {
                session()->push('cart_product_id', $new_cart_product_id[$i]);
                session()->push('cart_product_qty', $new_cart_product_qty[$i]);
            }
        }

        if($error_msg==1)
        {
            return redirect()->back()->with('error', 'Those quantity will not be updated that are more than stock.');
        }

        return redirect()->back()->with('success', 'Cart is updated successfully!');
    }

    public function checkout()
    {
        if(!session()->get('cart_product_id'))
        {
            return redirect()->to('/');
        }
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $shipping_data = DB::table('shippings')->orderBy('shipping_order', 'asc')->get();

        if(!session()->get('shipping_id'))
        {
            session()->put('shipping_id', 0);
            session()->put('shipping_cost', '0');
        }

        if(!session()->get('coupon_id'))
        {
            session()->put('coupon_id', 0);
            session()->put('coupon_code', '');
            session()->put('coupon_amount', '0');
        }

        return view('pages.checkout', compact('g_setting', 'shipping_data'));
    }

    public function shipping_update(Request $request)
    {
        $shipping_id = $request->input('shipping_id');
        $shipping_detail = DB::table('shippings')->where('id', $shipping_id)->first();

        session()->put('shipping_id', $shipping_id);
        session()->put('shipping_cost', $shipping_detail->shipping_cost);

        return redirect()->back()->with('success', 'Shipping method is selected successfully!');
    }

    public function coupon_update(Request $request)
    {
        $coupon_code = $request->input('coupon_code');
        $today = date('Y-m-d');

        $coupon_detail = DB::table('coupons')->where('coupon_code', $coupon_code)->first();
		if(!$coupon_detail) {
            return redirect()->back()->with('error', 'Wrong coupon code!');
        }

        $coupon_id = $coupon_detail->id;
        $coupon_discount = $coupon_detail->coupon_discount;
        $coupon_type = $coupon_detail->coupon_type;

        if($coupon_detail->coupon_existing_use == $coupon_detail->coupon_maximum_use) {
            return redirect()->back()->with('error', 'Coupon code is maximum time used!');
        }

        if($today < $coupon_detail->coupon_start_date) {
            return redirect()->back()->with('error', 'Date of this coupon code is not come yet!');
        }

        if($today > $coupon_detail->coupon_end_date) {
            return redirect()->back()->with('error', 'Date of this coupon code is expired!');
        }

        if($coupon_type== 'Percentage') {
            $arr['coupon_amount'] = (session()->get('subtotal') * $coupon_discount)/100;
        } else {
            $arr['coupon_amount'] = $coupon_discount;
        }

        session()->put('coupon_code', $coupon_code);
        session()->put('coupon_amount', $arr['coupon_amount']);
        session()->put('coupon_id', $coupon_id);

        if(!session()->get('shipping_cost')) {
            $temp1 = 0;
        } else {
            $temp1 = session()->get('shipping_cost');
        }

        $final_price = (session()->get('subtotal')+$temp1)-session()->get('coupon_amount');
	    $arr['final_price'] = $final_price;

        return redirect()->back()->with('success', 'Coupon is selected successfully!');
    }

}
