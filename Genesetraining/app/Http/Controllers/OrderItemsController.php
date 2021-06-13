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

    
    // public function store(Request $request)
    // {
        //return $request;
        // $order_id = session('order_id',0);
        //return $order_id;
        // $user = Auth::user();
        // $address = $user->address;
        //checking if there is valid order id in the session
        // if($order_id < 1){
            //if no order then order is created
            // $order = new Order();
            // $order->user_id = auth::id();
            // $order->user_id = Auth::id();
            // $order->order_status = 'cart';
            // $order->sub_total = 0;
            // $order->discount = 0;
            // $order->shipping_price = 0;
            // $order->total_price = 0;
            // $order->shipping_address ='';
            // $order->save();
            // session(['order_id'=>$order->id]);
            // $order_id = $order->id;
        // }
        //adding items to cart ->creating new order item
        // $order_item = new OrderItems();
        // $order_item->order_id = $order_id;
        // $order_item->product_id = $request->input('product_id');
        // $product = product::find($order_item->product_id);
        // $order_item->product_price = $product->price;
        // $order_item->quantity = $request->input('quantity');
        // $order_item->total = $order_item->quantity *  $order_item->product_price ;
        // $order_item->save();
        
        // updating order table with total price
        // $order_update =  Order::find($order_id);
        // $order_update->sub_total +=$order_item->total;
        // $order_update->total_price +=$order_item->total;
        // $order_update->save();
        // return redirect('/order');
        
    // }
    public function store(Request $request)
    {
        //return $request;
       // $order_id = session('order_id',0);
        // $order_id = request()->session()->get('order_id', '0');

        $key = Auth::user()->id;
       // return $order_id;
        //$result = Order::where('user_id','=',$order_id);


        // $result = Order::whereUserId($key)->get();  
        // return $result[0]->user_id;

  
        $result = Order::whereUserId($key)->first(); //returns array
        if($result){
               if($result->user_id == $key){
                     //adding items to cart ->creating new order item
                    $order_item = new OrderItems();
                    $order_item->order_id = $result->id;
                     $order_item->product_id = $request->input('product_id');
                     $product = product::find($order_item->product_id);
                    $order_item->product_price = $product->price;
                   $order_item->quantity = $request->input('quantity');
                   $order_item->total = $order_item->quantity *  $order_item->product_price ;
                    $order_item->save();
                    session(['order_id'=>$result->id]);

        $order_update =  Order::whereUserId($key)->first();
        $order_update->sub_total +=$order_item->total;
        $order_update->total_price +=($order_item->total+ $order_update->shipping_price - $order_update->discount);
        $order_update->save();
        return redirect('/order');
               }
              }

                $order = new Order();
                $order->user_id = Auth::id();
                $order->order_status = 'cart';
                $order->sub_total = 0;
                $order->discount = 0;
                $order->shipping_price = 0;
                $order->total_price = 0;
                $order->shipping_address ='';
                $order->save();
                session(['order_id'=>$order->id]);
                $key = $order->user_id;
            //adding items to cart ->creating new order item
            $order_item = new OrderItems();
            $order_item->order_id = $order->id;
            $order_item->product_id = $request->input('product_id');
            $product = product::find($order_item->product_id);
            $order_item->product_price = $product->price;
            $order_item->quantity = $request->input('quantity');
            $order_item->total = $order_item->quantity *  $order_item->product_price ;
            $order_item->save();
    
            $order_update =  Order::whereUserId($key)->first();
           // return $order_update;
            $order_update->sub_total +=$order_item->total;
            $order_update->total_price +=($order_item->total+ $order_update->shipping_price - $order_update->discount);
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

    
    public function update(Request $request, $id)
    {
        $product = OrderItems::find($id);
        //return $item;
        $product->quantity = $request->input('quantity');
        $product->total = $product->quantity * $product->product_price;
        $product->save();
        $product->order->sub_total = ($product->order->sub_total - $product->product_price + $product->total);
        $product->order->total_price = ($product->order->total_price - $product->product_price + $product->total);
        $product->order->save();
        return redirect('/order');
    }

    
    public function destroy($id)
    {
         $item = OrderItems::find($id);

         $item->order->sub_total -=$item->total;
         $item->order->total_price -=$item->total; 
         $item->order->save();
         $item->delete();
         return redirect('/order');

    }
}
