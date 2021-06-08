<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class OrderItemsController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //return $request;
        $order_id = session('order_id',0);
        //return $order_id;
        // $user = Auth::user();
        // $address = $user->address;
        //checking if there is valid order id in the session
        if($order_id < 1){
            //if no order then order is created
            $order = new Order();
            // $order->user_id = auth::id();
            $order->user_id = Auth::id();
            $order->order_status = 'cart';
            $order->sub_total = 0;
            $order->discount = 0;
            $order->shipping_price = 0;
            $order->total_price = 0;
            $order->shipping_address ='';
            $order->save();
            session(['order_id'=>$order->id]);
            $order_id = $order->id;
        }
        //adding items to cart ->creating new order item
        $order_item = new OrderItems();
        $order_item->order_id = $order_id;
        $order_item->product_id = $request->input('product_id');
        $product = product::find($order_item->product_id);
        $order_item->product_price = $product->price;
        $order_item->quantity = $request->input('quantity');
        $order_item->total = $order_item->quantity *  $order_item->product_price ;
        $order_item->save();
        
        // updating order table with total price
        $order_update =  Order::find($order_id);
        $order_update->sub_total +=$order_item->total;
        $order_update->total_price +=$order_item->total;
        $order_update->save();
        return redirect('/order');
    }
    

    public function show(OrderItems $orderItems)
    {
        //
    }

    
    public function edit(OrderItems $orderItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItems $orderItems)
    {
        //
    }

    
    public function destroy(OrderItems $orderItems)
    {
        //
    }
}
