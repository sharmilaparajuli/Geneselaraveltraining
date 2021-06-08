<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // public function search(){
    //     //used to search
    //     $category = category::all();
    //     $products = product::latest();
    //     if(request('search') !== ' '){
    //         $products->where('product_name' , 'like' , '%' . request('search') . '%')
    //         ->orwhere('product_desc' , 'like' , '%' . request('search') . '%');

    //     } ;
        
    //     return view('products'  ,['categories'=>$category , 'products'=> $products->get()]);
    // }
public function search(){
    // return request(['search' , 'category']);
    $category = category::all();
      $products = product::latest()->search(request(['search' , 'category']))->get();
      return view('products'  ,['categories'=>$category , 'products'=> $products]);
}


   
}
