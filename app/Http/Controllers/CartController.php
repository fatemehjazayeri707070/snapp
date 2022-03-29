<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function manage(Product $product, Request $request)
    {
        $type = $request->type;
        $currentLoggedInUser = auth()->user();
        if ($currentLoggedInUser) {
            $cart = Cart::firstOrCreate(['user_id' => $currentLoggedInUser->id]);
            if ($cart_item = $product->isInCart()) {
                if ($type == 'minus' && $cart_item->count == 1) {
                    $cart_item->delete();
                    return back()->withMessage('آیتم مورد نظر از سبد خرید شما حذف شد.');
                }else {
                    if ($type == 'add') {
                        $cart_item->count++;
                    }else {
                        $cart_item->count--;
                    }
                    $cart_item->payable = $cart_item->count * $product->cost;
                    $cart_item->save();
                }
                $cart_item->payable = $cart_item->count * $product->cost;
                $cart_item->save();
            }else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'count' => 1,
                    'payable' => $product->cost,
                ]);
            }
            return back()->withMessage('آیتم مورد نظر به سبد خرید اضافه شد.');
        }else {
            return back()->withError('لطفا ابتدا وارد حساب کاربری خود شوید.');
        }
    }
    public function remove(CartItem $cart_item)
    {
        $cart_item->delete();
        return back()->withMessage('آیتم مورد نظر از سبد خرید شما حذف شد.');
    }
}