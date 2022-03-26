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
        'discount' => 'nullable|integer|between:0,100',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2000'
    ];

    public function __construct()
    {
        $this->middleware(['auth', 'admins']);
    }

    public function index(Request $request)
    {
        $shops = Shop::all();
        $products = Product::query();
        if (auth()->user()->role=='admin') {
            if ($request->s) {
                $products = $products->where('shop_id', $request->s);
            }
        
        }else {
            $products = $products->where('shop_id', currentShopId());
        }

        if ($request->t) {
            $products = $products->where('title', 'like', "%$request->t%");
        }

        if ($request->d) {
            $products = $products->withTrashed();
        }

        if ($order = $request->o) {
            if ($order == 1) {
                $products = $products->orderBy('price', 'ASC');
            }
            if ($order == 2) {
                $products = $products->orderBy('price', 'DESC');
            }
            if ($order == 3) {
                $products = $products->latest(); // $products->orderBy('created_at', 'DESC');
            }
            if ($order == 4) {
                $products = $products->orderBy('created_at', 'ASC');
            }}
            $products = $products->get();
        return view('product.index', compact('products','shops'));
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

        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }
        if (!$data['discount']) {
            $data['discount'] = 0;
        }

        $currentUser = auth()->user();
        if ($currentUser->role=='admin') {
    
            $data['shop_id'] = $request->shop_id;
        }else {
            $data['shop_id'] = currentShopId();
        }
        Product::create($data);
        return redirect()->route('product.index')->withMessage( __('SUCCESS') );
    }

    public function edit(Product $product)
    {
        checkPolicy('product', $product);
        $shops = Shop::all();
        
        if (!$product->discount) {
            $product->discount = 0;
        }
        return view('product.form', compact('product', 'shops'));
    }

    public function update(Request $request, Product $product)
    {
        checkPolicy('product', $product);
        $data = $request->validate($this->validationRules);
        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }
        $currentUser = auth()->user();
        if ($currentUser->role=='admin') {
            $data['shop_id'] = $request->shop_id;
        }
        $product->update($data);
        return redirect()->route('product.index')->withMessage( __('SUCCESS') );
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->firstOrFail();
        $product->restore();
        return redirect()->route('product.index')->withMessage( __('SUCCESS') );
    }

    public function destroy(Product $product)
    {
        checkPolicy('product', $product);
        
        $product->delete();
        return redirect()->route('product.index')->withMessage( __('DELETED') );
    }
}