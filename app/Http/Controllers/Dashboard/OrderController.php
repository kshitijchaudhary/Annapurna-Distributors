<?php

namespace App\Http\Controllers\Dashboard;

use App\Clientinfo;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = array();

        foreach (Order::orderBy('id', 'desc')->get() as $item) {
            $product = Product::find($item->product_id);
            if (!$product) {
                $item->delete();
            }

            //check if order_no already in array
            if (in_array($item->user_id, array_column($orders, 'user_id'))) { // search value in the array

                //update quantity / price


                $index = 0;
                foreach ($orders as $order) {
                    if ($order['user_id'] == $item->user_id) {

                        $orders[$index]['quantity'] =  $orders[$index]['quantity'] +  $item->quantity;
                        $orders[$index]['total'] = $orders[$index]['total'] + $product->price * $item->quantity;
                    }
                    $index++;
                }
            } else {

                //new instance
                $temp_array = array(
                    'user_id' => $item->user_id,
                    'status' => $item->status,
                    'name' => $item->name,
                    'phone' => $item->phone,
                    'address' => $item->address,
                    'quantity' => $item->quantity,
                    'total' => $product->price * $item->quantity,
                );
                array_push($orders, $temp_array);
            }
        }


        return view('dashboard.order.index', compact(
            'orders',
        ));
    }
    // / orderView
    public function orderView($user_id)
    {
        $orders = array();
        $clientinfo = Order::where('user_id', $user_id)->first();
        foreach (Order::where('user_id', $user_id)->get() as $order) {


            $product = Product::find($order->product_id);
            if (!$product) {
                $order->delete();
            }

            array_push($orders, array(
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'product_id' => $order->product_id,
                'quantity' => $order->quantity,
                'img' => $product->img,
                'product_name' => $product->name,
                'price' => $product->price,
                'desc' => $product->desc,
                'subcat_id' => $product->subcat_id,
            ));
        }



        return view('dashboard.order.view', compact(
            'orders',
            'clientinfo'
        ));
    }
    public function markOrderComplete($user_id)
    {
        $orders = array();
        foreach (Order::where('user_id', $user_id)->get() as $order) {



            $product = Product::find($order->product_id);
            if (!$product) {
                $order->delete();
            }

            $order->status = "complete";
            $order->save();
        }



        return redirect('/dashboard/order/view/' . $user_id);
    }
    public function markOrderIncomplete($user_id)
    {
        $orders = array();
        foreach (Order::where('user_id', $user_id)->get() as $order) {



            $product = Product::find($order->product_id);
            if (!$product) {
                $order->delete();
            }

            $order->status = "incomplete";
            $order->save();
        }



        return redirect('/dashboard/order/view/' . $user_id);
    }
    public function cancelOrder($user_id)
    {
        foreach (Order::where('user_id', $user_id)->get() as $order) {

            $product = Product::find($order->product_id);
            if (!$product) {
                $order->delete();
            }

            $product->quantity = $product->quantity + $order->quantity;
            $product->save();
            $order->delete();
        }



        return redirect('/dashboard/orders');
    }
}
