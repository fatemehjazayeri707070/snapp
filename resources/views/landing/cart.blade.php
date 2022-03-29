@extends('layouts.landing')
@section('content')

    <h4> سبد خرید شما </h4>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> ردیف </th>
                <th> محصول </th>
                <th> تعداد </th>
                <th> قابل پرداخت </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart->items as $key => $item)
                <tr>
                    <th> {{$key+1}} </th>
                    <td> {{$item->product->title ?? '-'}} </td>
                    <td> {{$item->count}} </td>
                    <td> {{number_format($item->payable)}} </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"> جمع کل </td>
                <td> {{number_format($cart->sum)}} تومان </td>
            </tr>
        </tbody>
    </table>

@endsection