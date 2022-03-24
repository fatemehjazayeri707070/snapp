<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $validationRules = [
        'title' => 'required|string|min:3',
        'price' => 'required|integer',
        'discount' => 'nullable|integer|between:1,100',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2000'
    ];

    public function __construct()
    {
        $this->middleware(['auth', 'admins']);
    }

    public function index()
    {
        if (auth()->user()->role=='admin') {
            $products = Product::all();
        }else {
            $products = Product::where('shop_id', currentShopId())->get();
        }
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $product = new Product;
        $shops = Shop::all();
        return view('product.form', compact('product', 'shops'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules);

        $data['shop_id'] = currentShopId();
        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }
        Product::create($data);
        return redirect()->route('product.index')->withMessage( __('SUCCESS') );
    }

    public function edit(Product $product)
    {
        $shops = Shop::all();
        return view('product.form', compact('product', 'shops'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate($this->validationRules);
        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }
        $product->update($data);
        return redirect()->route('product.index')->withMessage( __('SUCCESS') );
    }

    public function destroy(Product $product)
    {
        
        $product->delete();
        return redirect()->route('product.index')->withMessage( __('DELETED') );
    }
}