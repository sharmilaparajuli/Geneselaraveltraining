<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index()
    {
        $categories = category::all();
        $order_id = session('order_id',0);
        $order = Order::find($order_id);
        $orderitem = OrderItems::whereOrderId($order_id)->get();
        return view('cart',[ 'categories'=>$categories , 'orderitem'=>$orderitem,'order'=>$order]);
        // return $order_item;
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }

    
    public function update(Request $request, Order $order)
    {
        //
    }

    
    public function destroy(Order $order)
    {
        //
    }
}
