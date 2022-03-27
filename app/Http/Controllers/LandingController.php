<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;

class LandingController extends Controller
{
    public function loadPage($page)
    {
        if (method_exists($this, $page)) {
            return $this->$page();
        }else {
            abort(404);
        }
    }

    public function products()
    {
        $products = Product::query();
        if ($p = request('p')) {
            $products = $products->where('title', 'like', "%$p%");
        }
        if ($o = request('o')) {
            if ($o == 1) {
                $products = $products->latest();
            }
            if ($o == 2) {
                $products = $products->orderBy('price', 'ASC');
            }
            if ($o == 3) {
                $products = $products->orderBy('price', 'DESC');
            }
        }
        $products = $products->paginate(9);
        return view('landing.products', compact('products'));
    }

    public function shops()
    {
        return view('landing.shops');
    }
}
