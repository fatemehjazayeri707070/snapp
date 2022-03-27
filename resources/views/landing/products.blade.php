@extends('layouts.landing')
@section('content')

    <h4> محصولات </h4>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 my-3 product-card">
                <div class="d-flex justify-content-between">
                    <h5> {{$product->title}} </h5>
                    <p>
                        @if ($product->discount)
                            <span class="text-danger off mx-2"> {{number_format($product->price)}} </span>
                        @endif
                        <span> {{number_format($product->cost)}} </span>
                    </p>
                </div>
                <hr>
                <img src="{{asset($product->image ?? 'img/empty.png')}}">
                
                <p class="mt-3">
                    @if ($product->description)
                        {{$product->description}}
                    @else
                        <em> بدون توضیحات ... </em>
                    @endif
                </p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#"> {{$product->shop->title ?? '-'}} </a>
                    <button type="button" class="btn btn-info text-white px-3 btn-sm"> اضافه کردن به سبد خرید </button>
                </div>
            </div>
        @endforeach
    </div>

@endsection