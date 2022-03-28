@extends('layouts.landing')
@section('content')

<h4 class="text-center"> محصولات </h4>
    <hr>
    <form class="row justify-content-center align-items-center" method="get">
        <div class="col-md-4 from-group">
            <label class="mb-2"> نام محصول </label>
            <input type="text" name="p" class="form-control" value="{{request('p')}}">
        </div>
        <div class="col-md-4 from-group">
            <label class="mb-2">مرتب سازی بر حسب</label>
            <select class="form-control" name="o">
                <option value=""> -- انتخاب کنید -- </option>
                <option value="1" @if(request('o') == 1) selected @endif> جدیدترین </option>
                <option value="2" @if(request('o') == 2) selected @endif> ارزانترین </option>
                <option value="3" @if(request('o') == 3) selected @endif> گرانترین </option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary"> جستجو </button>
        </div>
    </form>
    <hr>
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
                <form class="d-flex justify-content-between align-items-center" method="post" action="{{route('cart.add', $product->id)}}">
                    @csrf
                    <a href="#"> {{$product->shop->title ?? '-'}} </a>
                    @if ($cart_item = $product->isInCart())
                        <div>
                            <button type="submit" class="btn btn-warning text-white btn-sm"> - </button>
                            <span class="cart-count"> {{$cart_item->count}} </span>
                            <button type="submit" class="btn btn-warning text-white btn-sm"> + </button>
                        </div>
                    @else
                        <button type="submit" class="btn btn-info text-white px-3 btn-sm"> اضافه کردن به سبد خرید </button>
                    @endif
                </form>
            </div>
        @endforeach
    </div>
    <hr>

    {{$products->links()}}

@endsection