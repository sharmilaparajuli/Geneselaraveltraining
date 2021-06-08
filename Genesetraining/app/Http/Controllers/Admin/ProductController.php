<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $products =product::latest()->get();
        return view('admin.products.index' , ['products' => $products]);
    }

    
    public function create()
    {
        $categories=category::all();
        return view('admin.products.create' , ['categories' => $categories]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255|unique:products',
            'product_desc' => 'required|max:255',
            'price' => 'required|integer|',
            'category_id' => 'required|integer|min:1',
            
        ]);
    
        $product = new product;
        $product->product_name = $request->input('product_name');
        $product->product_desc = $request->input('product_desc');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save();
        return redirect('/admin/products');



    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(product $product)
    {
        
        $categories=category::all();
        return view('admin.products.edit' ,compact('product' , 'categories'));
       
    }

    
    public function update(Request $request,Product $product )
    {
        // return $product;


        $validated = $request->validate([
            'product_name' => 'required|max:255|unique:products',
            'product_desc' => 'required|max:255',
            'price' => 'required|integer|',
            'category_id' => 'required|integer|min:1',
            
        ]);
    $product->product_name=$request->get('product_name');
    $product->product_desc=$request->get('product_desc');
    $product->price=$request->get('price');
    $product->category_id=$request->get('category_id');
    $product->save();
    return redirect('/admin/products');
   
    }
    
    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete($id);
        return redirect('/admin/products');
    }
}
