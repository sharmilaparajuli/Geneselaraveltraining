<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $categories = category::all();
        $products = product::latest()->get();
         return view('home', [ 'categories'=> $categories , 'products' => $products]);
    }
}