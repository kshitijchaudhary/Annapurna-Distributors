<?php

namespace App\Http\Controllers\site;

use App\Cart;
use App\Clientinfo;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::all()->take(20);

        return view(
            'site.home',
            compact(
                'products'
            )
        );
    }

    public function singleProduct($product_id)
    {
        $product  = Product::find($product_id);

        if ($product) {

            $products = Product::all()->take(10);

            return view(
                'site.product',
                compact(
                    'product',
                    'products'
                )
            );
        }
        return redirect('/');
    }
    public function subcatProduct($subcat_id, $subcatname)
    {
        $subcat  = Subcategory::find($subcat_id);

        if ($subcat) {

            $products = Product::where('subcat_id', $subcat->id)->get();
            // return $products;
            return view(
                'site.category',
                compact(
                    'products',
                    'subcat'
                )
            );
        }
        return redirect('/');
    }

    // / addToCart
    public function addToCart(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);


        $product = Product::find($request->product_id);
        if ($product && $request->quantity != 0) {

            // add to addToCart

            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
            $product->quantity =  $product->quantity - $request->quantity;
            $product->save();

            return redirect('/cart');
        }

        return redirect('/product/' . $request->product_id);
    }

    public function cart()
    {
        $products = array();

        foreach (Cart::where('user_id', Auth::user()->id)->get() as $cart) {

            $product = Product::find($cart->product_id);
            if ($product) {

                array_push($products, array(
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'img' => $product->img,
                    'name' => $product->name,
                    'quantity' => $cart->quantity,
                    'price' => $product->price,
                    'desc' => $product->desc,
                    'subcat_id' => $product->subcat_id,
                ));
            } else {
                $cart->delete();
            }
        }


        return view(
            'site.cart',
            compact(
                'products'
            )
        );
    }


    public function removeCart($cart_id)
    {
        $cart  = Cart::find($cart_id);

        if ($cart) {

            $product = Product::find($cart->product_id);
            if ($product) {
                $product->quantity =  $product->quantity + $cart->quantity;
                $product->save();
            }
            $cart->delete();
            return redirect('/cart');
        }
        return redirect('/');
    }

    public function cartOrderInfo()
    {
        $clientinfo = Clientinfo::where('user_id', Auth::user()->id)->first();

        return view(
            'site.cart-order-info',
            compact(
                'clientinfo'
            )
        );
    }

    public function cartOrderConfirm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);


        foreach (Cart::where('user_id', Auth::user()->id)->get() as $cart) {

            $product = Product::find($cart->product_id);
            if ($product) {

                Order::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address, 
                ]);
            }
            $cart->delete();
        }
  
        return redirect('/');
    }
}
