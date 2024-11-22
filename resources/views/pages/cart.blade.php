@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_cart) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ CART }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ CART }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content pt_50 pb_60">
        <div class="container">
            <div class="row cart">
                <div class="col-md-12">
                    @if(Session::has('cart_product_id'))
                    <form action="{{ url('cart/update') }}" method="post">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="table-info">
                                    <th>{{ SERIAL }}</th>
                                    <th>{{ THUMBNAIL }}</th>
                                    <th>{{ PRODUCT_NAME }}</th>
                                    <th>{{ UNIT_PRICE }}</th>
                                    <th>{{ QUANTITY }}</th>
                                    <th>{{ SUB_TOTAL }}</th>
                                    <th>{{ ACTION }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $value = '';
                                    $itm = '';
                                    $arr_cart_product_id = array();
                                    $arr_cart_product_qty = array();
                                    $subtotal = 0;
                                @endphp
                                @php $i=0 @endphp
                                @foreach(Session::get('cart_product_id') as $value)
                                    @php
                                        $i++;
                                        $arr_cart_product_id[$i] = $value;
                                    @endphp
                                @endforeach

                                @php $i=0 @endphp
                                @foreach(Session::get('cart_product_qty') as $value)
                                    @php
                                        $i++;
                                        $arr_cart_product_qty[$i] = $value;
                                    @endphp
                                @endforeach

                                @php $tot1 = 0 @endphp
                                @for($i=1;$i<=count($arr_cart_product_id);$i++)

                                    @php
                                        $all_data = DB::table('products')->where('id', $arr_cart_product_id[$i])->get();
                                    @endphp

                                    @foreach ($all_data as $itm)
                                        @php
                                            $product_name = $itm->product_name;
                                            $product_slug = $itm->product_slug;
                                            $product_current_price = $itm->product_current_price;
                                            $product_featured_photo = $itm->product_featured_photo;
                                        @endphp
                                    @endforeach

                                    <input type="hidden" name="product_id[]" value="{{ $arr_cart_product_id[$i] }}">
                                    <tr>
                                        <td class="align-middle">{{ $i }}</td>
                                        <td class="align-middle"><img src="{{ asset('uploads/'.$product_featured_photo) }}"></td>
                                        <td class="align-middle">
                                            <a href="{{ url('product/'.$product_slug) }}">{{ $product_name }}</a>
                                        </td>
                                        <td class="align-middle">${{ $product_current_price }}</td>
                                        <td class="align-middle">
                                            <input type="number" class="form-control" name="product_qty[]" step="1" min="1" max="" pattern="" pattern="[0-9]*" inputmode="numeric" value="{{ $arr_cart_product_qty[$i] }}">
                                        </td>
                                        <td class="align-middle">
                                            ${{ $subtotal = $product_current_price * $arr_cart_product_qty[$i] }}
                                        </td>
                                        <td class="align-middle">
                                        <a href="{{ url('cart/delete/'.$arr_cart_product_id[$i]) }}" class="cart_button_arefin btn btn-xs btn-danger" onClick="return confirm('{{ ARE_YOU_SURE }}');"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    @php $tot1 = $tot1 + $subtotal; @endphp
                                @endfor

                                <tr>
                                    <td colspan="5" class="text-right">{{ TOTAL }} </td>
                                    <td colspan="2">$<span class="update_subtotal">{{ $tot1 }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-buttons">
                            <a href="{{ route('front.shop') }}" class="btn btn-info btn-arf">{{ CONTINUE_SHOPPING }}</a>
                            <input type="submit" value="{{ UPDATE_CART }}" class="btn btn-info btn-arf" name="form1">
                            <a href="{{ route('front.checkout') }}" class="btn btn-info btn-arf">{{ CHECKOUT }}</a>
                        </div>
                    </form>

                    @else
                        {{ CART_EMPTY }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
