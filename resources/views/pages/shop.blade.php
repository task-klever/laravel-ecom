@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-image: url({{ asset('uploads/'.$g_setting->banner_product) }})">
        <div class="bg-page"></div>
        <div class="text">
            <h1>{{ $shop->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ HOME }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $shop->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="page-content pt_60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! $shop->detail !!}
                </div>
            </div>
            <div class="row">

                @foreach($products as $row)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="product-item">
                        <div class="photo"><a href="{{ url('product/'.$row->product_slug) }}"><img src="{{ asset('uploads/'.$row->product_featured_photo) }}"></a></div>
                        <div class="text">
                            <h3><a href="{{ url('product/'.$row->product_slug) }}">{{ $row->product_name }}</a></h3>
                            <div class="price">

                                @if($row->product_old_price != '')
                                <del>${{ $row->product_old_price }}</del>
                                @endif

                                ${{ $row->product_current_price }}
                            </div>
                            <div class="cart-button">

                                @if($row->product_stock == 0)
                                <a href="javascript:void(0);" class="stock-empty w-100-p text-center">{{ STOCK_EMPTY }}</a>
                                @else
                                <form action="{{ route('front.add_to_cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $row->id }}">
                                    <input type="hidden" name="product_qty" value="1">
                                    <button type="submit">{{ ADD_TO_CART }}</button>
                                </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-md-12">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
