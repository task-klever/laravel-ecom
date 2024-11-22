<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Hash;
use DB;
use Auth;
use App\Mail\OrderCompletedEmailToCustomer;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class CheckoutController extends Controller
{
    public function login(Request $request)
    {
        if(!session()->get('cart_product_id'))
        {
            return redirect()->to('/');
        }
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ], [],
            [
                'email' => 'Customer Email',
                'password' => 'Customer Password'
            ]
        );

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Active'
        ];

        if(Auth::guard('customer')->attempt($credential)) {
            return redirect()->route('front.checkout')->with('success', 'You are successfully logged in as customer!');
        } else {
            return redirect()->route('customer.login')->with('error', 'Information is not correct!');
        }
       
    }


    public function billing_shipping(Request $request)
    {
        if(!session()->get('cart_product_id'))
        {
            return redirect()->to('/');
        }

        $request->validate(
            [
                'billing_name' => 'required',
                'billing_email' => 'required|email',
                'billing_phone' => 'required',
                'billing_country' => 'required',
                'billing_address' => 'required',
                'billing_state' => 'required',
                'billing_city' => 'required',
                'billing_zip' => 'required',
            ]
        );

        if($request->name_click_shipping_same_check!=null) {
            $request->validate(
            [
                'shipping_name' => 'required',
                'shipping_email' => 'required|email',
                'shipping_phone' => 'required',
                'shipping_country' => 'required',
                'shipping_address' => 'required',
                'shipping_state' => 'required',
                'shipping_city' => 'required',
                'shipping_zip' => 'required',
            ]
        );
        }

        session()->put('billing_name',$request->billing_name);
        session()->put('billing_email',$request->billing_email);
        session()->put('billing_phone',$request->billing_phone);
        session()->put('billing_country',$request->billing_country);
        session()->put('billing_address',$request->billing_address);
        session()->put('billing_state',$request->billing_state);
        session()->put('billing_city',$request->billing_city);
        session()->put('billing_zip',$request->billing_zip);
        session()->put('order_note',$request->order_note);

        if($request->name_click_shipping_same_check!=null)
        {
            session()->put('name_click_shipping_same_check', $request->name_click_shipping_same_check);
            session()->put('shipping_name',$request->shipping_name);
            session()->put('shipping_email',$request->shipping_email);
            session()->put('shipping_phone',$request->shipping_phone);
            session()->put('shipping_country',$request->shipping_country);
            session()->put('shipping_address',$request->shipping_address);
            session()->put('shipping_state',$request->shipping_state);
            session()->put('shipping_city',$request->shipping_city);
            session()->put('shipping_zip',$request->shipping_zip);
        }
        else
        {
            session()->forget('name_click_shipping_same_check');
            session()->put('shipping_name',$request->billing_name);
            session()->put('shipping_email',$request->billing_email);
            session()->put('shipping_phone',$request->billing_phone);
            session()->put('shipping_country',$request->billing_country);
            session()->put('shipping_address',$request->billing_address);
            session()->put('shipping_state',$request->billing_state);
            session()->put('shipping_city',$request->billing_city);
            session()->put('shipping_zip',$request->billing_zip);
        }

        return redirect()->route('customer.payment');

    }

    public function payment()
    {
        if(!session()->get('cart_product_id'))
        {
            return redirect()->to('/');
        }

        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        return view('pages.payment', compact('g_setting'));
    }

    public function stripe(Request $request)
    {
        if(!session()->get('cart_product_id'))
        {
            return redirect()->to('/');
        }

        if(session()->get('shipping_cost')) {
            $final_price = (session()->get('subtotal') + session()->get('shipping_cost'))-session()->get('coupon_amount');
        } else {
            $final_price =session()->get('subtotal') - session()->get('coupon_amount');
        }

        \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));
        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Products'
                        ],
                        'unit_amount' => $final_price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('customer.stripe.success'),
            'cancel_url' => route('customer.stripe.cancel'),
        ]);

        session()->put('final_price', $final_price);
        session()->put('payment_intent', $response->payment_intent);

        return redirect()->away($response->url);
    }


    public function stripe_success(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));

        if(!session()->get('payment_intent')) {
            return redirect()->to('/');
        }

        $payment_intent_id = session()->get('payment_intent');
        $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

        $exp_month = $payment_intent->charges->data[0]->payment_method_details->card->exp_month;
        $exp_year = $payment_intent->charges->data[0]->payment_method_details->card->exp_year;
        $last4 = $payment_intent->charges->data[0]->payment_method_details->card->last4;
                
        if($payment_intent->status == 'succeeded') {
            
            $transactionId = $payment_intent->id;

            $order_no = uniqid();

            $obj = new Order();
            if(Auth::guard('customer')->user())
            {
                $obj->customer_id = Auth::guard('customer')->user()->id;
                $obj->customer_name = Auth::guard('customer')->user()->name;
                $obj->customer_email = Auth::guard('customer')->user()->email;
                $obj->customer_type = 'Returning Customer';
            }
            else
            {
                $obj->customer_id = 0;
                $obj->customer_name = session()->get('billing_name');
                $obj->customer_email = session()->get('billing_email');
                $obj->customer_type = 'Guest';
            }

            $obj->billing_name = session()->get('billing_name');
            $obj->billing_email = session()->get('billing_email');
            $obj->billing_phone = session()->get('billing_phone');
            $obj->billing_country = session()->get('billing_country');
            $obj->billing_address = session()->get('billing_address');
            $obj->billing_state = session()->get('billing_state');
            $obj->billing_city = session()->get('billing_city');
            $obj->billing_zip = session()->get('billing_zip');

            $obj->shipping_name = session()->get('shipping_name');
            $obj->shipping_email = session()->get('shipping_email');
            $obj->shipping_phone = session()->get('shipping_phone');
            $obj->shipping_country = session()->get('shipping_country');
            $obj->shipping_address = session()->get('shipping_address');
            $obj->shipping_state = session()->get('shipping_state');
            $obj->shipping_city = session()->get('shipping_city');
            $obj->shipping_zip = session()->get('shipping_zip');

            $obj->order_note = session()->get('order_note');
            $obj->txnid = $transactionId;
            $obj->shipping_cost = session()->get('shipping_cost');
            $obj->coupon_code = session()->get('coupon_code');
            $obj->coupon_discount = session()->get('coupon_amount');

            $obj->paid_amount = session()->get('final_price');
            $obj->card_last4 = $last4;
            $obj->card_exp_month = $exp_month;
            $obj->card_exp_year = $exp_year;
            $obj->payment_method = 'Stripe';
            $obj->payment_status = 'Completed';
            $obj->order_no = $order_no;
            $obj->created_at = date('Y-m-d H:i:s');
            $obj->save();
            $last_id = $obj->id;

            $product_row = '';
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

            for($i=0;$i<count($arr_cart_product_id);$i++)
            {
                $product_detail = Product::where('id', $arr_cart_product_id[$i])->first();
                
                $obj = new OrderDetail();
                $obj->order_id = $last_id;
                $obj->product_id = $product_detail->id;
                $obj->product_name = $product_detail->product_name;
                $obj->product_price = $product_detail->product_current_price;
                $obj->product_qty = $arr_cart_product_qty[$i];
                $obj->payment_status = 'Completed';
                $obj->order_no = $order_no;
                $obj->created_at = date('Y-m-d H:i:s');
                $obj->save();

                // Update Stock in Database
                $current_stock = $product_detail->product_stock - $arr_cart_product_qty[$i];
                $data3['product_stock'] = $current_stock;
                DB::table('products')->where('id',$product_detail->id)->update($data3);

                $product_row .= '
                <b>Product #'.($i+1).'</b><br>
                Product Name: '.$product_detail->product_name.'<br>
                Product Price: $'.$product_detail->product_current_price.'<br>
                Product Quantity: '.$arr_cart_product_qty[$i].'<br>
                ';
            }


            // Send Email To Customer
            $payment_method = 'Payment Method: Stripe';
            $email_template_data = DB::table('email_templates')->where('id', 8)->first();
            $subject = $email_template_data->et_subject;
            $message = $email_template_data->et_content;

            $message = str_replace('[[customer_name]]', session()->get('customer_name'), $message);
            $message = str_replace('[[order_number]]', $order_no, $message);
            $message = str_replace('[[payment_method]]', $payment_method, $message);
            $message = str_replace('[[payment_date_time]]', date('Y-m-d H:i:s'), $message);
            $message = str_replace('[[transaction_id]]', $transactionId, $message);
            $message = str_replace('[[shipping_cost]]', '$'.session()->get('shipping_cost'), $message);
            $message = str_replace('[[coupon_code]]', session()->get('coupon_code'), $message);
            $message = str_replace('[[coupon_discount]]', '$'.session()->get('coupon_amount'), $message);
            $message = str_replace('[[paid_amount]]', '$'.session()->get('final_price'), $message);
            $message = str_replace('[[payment_status]]', 'Completed', $message);
            $message = str_replace('[[billing_name]]', session()->get('billing_name'), $message);
            $message = str_replace('[[billing_email]]', session()->get('billing_email'), $message);
            $message = str_replace('[[billing_phone]]', session()->get('billing_phone'), $message);
            $message = str_replace('[[billing_country]]', session()->get('billing_country'), $message);
            $message = str_replace('[[billing_address]]', session()->get('billing_address'), $message);
            $message = str_replace('[[billing_state]]', session()->get('billing_state'), $message);
            $message = str_replace('[[billing_city]]', session()->get('billing_city'), $message);
            $message = str_replace('[[billing_zip]]', session()->get('billing_zip'), $message);
            $message = str_replace('[[shipping_name]]', session()->get('shipping_name'), $message);
            $message = str_replace('[[shipping_email]]', session()->get('shipping_email'), $message);
            $message = str_replace('[[shipping_phone]]', session()->get('shipping_phone'), $message);
            $message = str_replace('[[shipping_country]]', session()->get('shipping_country'), $message);
            $message = str_replace('[[shipping_address]]', session()->get('shipping_address'), $message);
            $message = str_replace('[[shipping_state]]', session()->get('shipping_state'), $message);
            $message = str_replace('[[shipping_city]]', session()->get('shipping_city'), $message);
            $message = str_replace('[[shipping_zip]]', session()->get('shipping_zip'), $message);
            $message = str_replace('[[product_detail]]', $product_row, $message);

            Mail::to(Auth::guard('customer')->user()->email)->send(new OrderCompletedEmailToCustomer($subject,$message));

            session()->forget('billing_name');
            session()->forget('billing_email');
            session()->forget('billing_phone');
            session()->forget('billing_country');
            session()->forget('billing_address');
            session()->forget('billing_state');
            session()->forget('billing_city');
            session()->forget('billing_zip');

            session()->forget('name_click_shipping_same_check');

            session()->forget('shipping_name');
            session()->forget('shipping_email');
            session()->forget('shipping_phone');
            session()->forget('shipping_country');
            session()->forget('shipping_address');
            session()->forget('shipping_state');
            session()->forget('shipping_city');
            session()->forget('shipping_zip');

            session()->forget('order_note');

            session()->forget('cart_product_id');
            session()->forget('cart_product_qty');

            session()->forget('shipping_id');
            session()->forget('shipping_cost');

            session()->forget('coupon_code');
            session()->forget('coupon_amount');
            session()->forget('coupon_id');

            session()->forget('final_price');
            session()->forget('payment_intent');

            return redirect()->to('/')->with('success', 'Payment is successful!');
        } else {
            return redirect()->route('customer.stripe.cancel');
        }
    }

    public function stripe_cancel()
    {
        return redirect()->to('/')->with('error', 'Payment is cancelled!');
    }


    public function paypal(Request $response)
    {
        if(!session()->get('cart_product_id'))
        {
            return redirect()->to('/');
        }

        if(session()->get('shipping_cost')) {
            $final_price = (session()->get('subtotal') + session()->get('shipping_cost'))-session()->get('coupon_amount');
        } else {
            $final_price =session()->get('subtotal') - session()->get('coupon_amount');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('customer.paypal.success'),
                "cancel_url" => route('customer.paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $final_price
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id']!=null) {
            foreach($response['links'] as $link) {
                if($link['rel'] === 'approve') {
                    session()->put('final_price', $final_price);
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('customer.paypal.cancel');
        }
    }

    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        $txnid = $response['purchase_units'][0]['payments']['captures'][0]['id'];

        if(isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            $order_no = uniqid();

            $obj = new Order();
            if(Auth::guard('customer')->user())
            {
                $obj->customer_id = Auth::guard('customer')->user()->id;
                $obj->customer_name = Auth::guard('customer')->user()->name;
                $obj->customer_email = Auth::guard('customer')->user()->email;
                $obj->customer_type = 'Returning Customer';
            }
            else
            {
                $obj->customer_id = 0;
                $obj->customer_name = session()->get('billing_name');
                $obj->customer_email = session()->get('billing_email');
                $obj->customer_type = 'Guest';
            }

            $obj->billing_name = session()->get('billing_name');
            $obj->billing_email = session()->get('billing_email');
            $obj->billing_phone = session()->get('billing_phone');
            $obj->billing_country = session()->get('billing_country');
            $obj->billing_address = session()->get('billing_address');
            $obj->billing_state = session()->get('billing_state');
            $obj->billing_city = session()->get('billing_city');
            $obj->billing_zip = session()->get('billing_zip');

            $obj->shipping_name = session()->get('shipping_name');
            $obj->shipping_email = session()->get('shipping_email');
            $obj->shipping_phone = session()->get('shipping_phone');
            $obj->shipping_country = session()->get('shipping_country');
            $obj->shipping_address = session()->get('shipping_address');
            $obj->shipping_state = session()->get('shipping_state');
            $obj->shipping_city = session()->get('shipping_city');
            $obj->shipping_zip = session()->get('shipping_zip');

            $obj->order_note = session()->get('order_note');
            $obj->txnid = $txnid;
            $obj->shipping_cost = session()->get('shipping_cost');
            $obj->coupon_code = session()->get('coupon_code');
            $obj->coupon_discount = session()->get('coupon_amount');

            $obj->paid_amount = session()->get('final_price');
            $obj->card_last4 = '';
            $obj->card_exp_month = '';
            $obj->card_exp_year = '';
            $obj->payment_method = 'PayPal';
            $obj->payment_status = 'Completed';
            $obj->order_no = $order_no;
            $obj->created_at = date('Y-m-d H:i:s');
            $obj->save();
            $last_id = $obj->id;

            $product_row = '';
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

            for($i=0;$i<count($arr_cart_product_id);$i++)
            {
                $product_detail = Product::where('id', $arr_cart_product_id[$i])->first();
                
                $obj = new OrderDetail();
                $obj->order_id = $last_id;
                $obj->product_id = $product_detail->id;
                $obj->product_name = $product_detail->product_name;
                $obj->product_price = $product_detail->product_current_price;
                $obj->product_qty = $arr_cart_product_qty[$i];
                $obj->payment_status = 'Completed';
                $obj->order_no = $order_no;
                $obj->created_at = date('Y-m-d H:i:s');
                $obj->save();

                // Update Stock in Database
                $current_stock = $product_detail->product_stock - $arr_cart_product_qty[$i];
                $data3['product_stock'] = $current_stock;
                DB::table('products')->where('id',$product_detail->id)->update($data3);

                $product_row .= '
                <b>Product #'.($i+1).'</b><br>
                Product Name: '.$product_detail->product_name.'<br>
                Product Price: $'.$product_detail->product_current_price.'<br>
                Product Quantity: '.$arr_cart_product_qty[$i].'<br>
                ';
            }


            // Send Email To Customer
            $payment_method = 'Payment Method: PayPal';
            $email_template_data = DB::table('email_templates')->where('id', 8)->first();
            $subject = $email_template_data->et_subject;
            $message = $email_template_data->et_content;

            $message = str_replace('[[customer_name]]', session()->get('customer_name'), $message);
            $message = str_replace('[[order_number]]', $order_no, $message);
            $message = str_replace('[[payment_method]]', $payment_method, $message);
            $message = str_replace('[[payment_date_time]]', date('Y-m-d H:i:s'), $message);
            $message = str_replace('[[transaction_id]]', $txnid, $message);
            $message = str_replace('[[shipping_cost]]', '$'.session()->get('shipping_cost'), $message);
            $message = str_replace('[[coupon_code]]', session()->get('coupon_code'), $message);
            $message = str_replace('[[coupon_discount]]', '$'.session()->get('coupon_amount'), $message);
            $message = str_replace('[[paid_amount]]', '$'.session()->get('final_price'), $message);
            $message = str_replace('[[payment_status]]', 'Completed', $message);
            $message = str_replace('[[billing_name]]', session()->get('billing_name'), $message);
            $message = str_replace('[[billing_email]]', session()->get('billing_email'), $message);
            $message = str_replace('[[billing_phone]]', session()->get('billing_phone'), $message);
            $message = str_replace('[[billing_country]]', session()->get('billing_country'), $message);
            $message = str_replace('[[billing_address]]', session()->get('billing_address'), $message);
            $message = str_replace('[[billing_state]]', session()->get('billing_state'), $message);
            $message = str_replace('[[billing_city]]', session()->get('billing_city'), $message);
            $message = str_replace('[[billing_zip]]', session()->get('billing_zip'), $message);
            $message = str_replace('[[shipping_name]]', session()->get('shipping_name'), $message);
            $message = str_replace('[[shipping_email]]', session()->get('shipping_email'), $message);
            $message = str_replace('[[shipping_phone]]', session()->get('shipping_phone'), $message);
            $message = str_replace('[[shipping_country]]', session()->get('shipping_country'), $message);
            $message = str_replace('[[shipping_address]]', session()->get('shipping_address'), $message);
            $message = str_replace('[[shipping_state]]', session()->get('shipping_state'), $message);
            $message = str_replace('[[shipping_city]]', session()->get('shipping_city'), $message);
            $message = str_replace('[[shipping_zip]]', session()->get('shipping_zip'), $message);
            $message = str_replace('[[product_detail]]', $product_row, $message);

            Mail::to(Auth::guard('customer')->user()->email)->send(new OrderCompletedEmailToCustomer($subject,$message));

            session()->forget('billing_name');
            session()->forget('billing_email');
            session()->forget('billing_phone');
            session()->forget('billing_country');
            session()->forget('billing_address');
            session()->forget('billing_state');
            session()->forget('billing_city');
            session()->forget('billing_zip');

            session()->forget('name_click_shipping_same_check');

            session()->forget('shipping_name');
            session()->forget('shipping_email');
            session()->forget('shipping_phone');
            session()->forget('shipping_country');
            session()->forget('shipping_address');
            session()->forget('shipping_state');
            session()->forget('shipping_city');
            session()->forget('shipping_zip');

            session()->forget('order_note');

            session()->forget('cart_product_id');
            session()->forget('cart_product_qty');

            session()->forget('shipping_id');
            session()->forget('shipping_cost');

            session()->forget('coupon_code');
            session()->forget('coupon_amount');
            session()->forget('coupon_id');

            session()->forget('final_price');

            return redirect()->to('/')->with('success', 'Payment is successful!');
        } else {
            return redirect()->route('customer.paypal.cancel');
        }
    }

    public function paypal_cancel()
    {
        return redirect()->to('/')->with('error', 'Payment is cancelled!');
    }
}
