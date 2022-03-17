<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        //
        $this->middleware(['auth', 'admins']);
    }
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    
    public function create()
    {
        $product = new Product;
        return view('product.form', compact('product'));
    }

  
    public function store(Request $request)
    {
        dd($request->all());
    }

   
    public function edit(Product $product)
    {
        return view('product.form', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        //
    }

   
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->withMessage( __('DELETED') );
    }
}
