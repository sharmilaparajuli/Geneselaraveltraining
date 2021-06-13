<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $categories = category::all();
        $products = product::latest()->get();
         return view('home', [ 'categories'=> $categories , 'products' => $products]);
    }
    public function checkout(){
        $categories = category::all();
        $order_id = session('order_id',0);
        $order = Order::find($order_id);
        $orderitem = OrderItems::whereOrderId($order_id)->get();
        return view('checkout',[ 'categories'=>$categories , 'orderitem'=>$orderitem,'order'=>$order]);
    }
    public function shop(){
        $products = product::latest()->get();
        $categories = category::all();
        $order_id = session('order_id',0);
        $order = Order::find($order_id);
        $orderitem = OrderItems::whereOrderId($order_id)->get();
         return view('shop-grid', [ 'categories'=> $categories ,'orderitem'=>$orderitem,'order'=>$order, 'products' => $products]);
    }
    public function contact(){
        $products = product::latest()->get();
        $categories = category::all();
        return view('contact', [ 'categories'=> $categories , 'products' => $products]);
}
}