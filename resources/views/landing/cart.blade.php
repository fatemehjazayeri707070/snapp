@extends('layouts.landing')
@section('content')

    <h4> سبد خرید شما </h4>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> ردیف </th>
                <th> محصول </th>
                <th> فروشگاه </th>
                <th> تعداد </th>
                <th> قابل پرداخت </th>
                <th> حذف </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart->items as $key => $item)
                <tr>
                    <th> {{$key+1}} </th>
                    <td> {{$item->product->title ?? '-'}} </td>
                    <td> {{$item->product->shop->title ?? '-'}} </td>
                    <td>
                        <form method="post" action="{{route('cart.manage', $item->product_id)}}">
                            @csrf
                            <button type="submit" name="type" value="minus" class="btn btn-warning text-white btn-sm"> - </button>
                            <span class="cart-count"> {{$item->count}} </span>
                            <button type="submit" name="type" value="add" class="btn btn-warning text-white btn-sm"> + </button>
                        </form>
                    </td>
                    <td> {{number_format($item->payable)}} </td>
                    <td>
                        <form class="" action="{{route('cart.remove', $item->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"> حذف </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4"> جمع کل </td>
                <td colspan="2"> {{number_format($cart->sum)}} تومان </td>
            </tr>
        </tbody>
    </table>

@endsection