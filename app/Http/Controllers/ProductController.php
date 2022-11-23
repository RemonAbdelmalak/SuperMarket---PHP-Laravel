<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index()
    {
       $product = Product::latest()->paginate(4);
        return view('product.index',compact('product'));
    }


    public function create()
    {
        return view('product.create');
    }

    
    public function store(Request $request)
    {
        $request->validate(([
            'name'=>'required',
            'price'=>'required',
            'bio'=>"required"
        ]));
        $product = Product::create($request->all());
        return redirect()->route('products.index')
        ->with('success',"Product added successfuly");
    }

    
    public function show(Product $product)
    {
        return view('product.show',compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit',compact('product'));
    }

   
    public function update(Request $request, Product $product)
    {
        $request->validate(([
            'name'=>'required',
            'price'=>'required',
            'bio'=>"required"
        ]));
        $product->update($request->all());
        return redirect()->route('products.index')
        ->with('success',"Product updated successfuly");
    }

    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success',"Product deleted successfuly");
    }
}
