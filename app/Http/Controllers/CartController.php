<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $product = null;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function showCart(){
        return view('home.cart-detail');
    }

    public function checkout(Request $request){
        $cart = session('cart') ? session('cart') : null;

        if($cart){
            $sub_total = 0;
            $total_amount = 0;

            $cart_id = \Str::random(15);
            foreach ($cart as $cart_items){
                $sub_total += $cart_items['total_amount'];

                $cart_array = array(
                    'cart_id' => $cart_id,
                    'product_id' => $cart_items['product_id'],
                    'user_id' => $request->user()->id,
                    'quantity' => $cart_items['quantity'],
                    'price' => $cart_items['price'],
                    'after_discount' => $cart_items['after_discount'],
                    'delivery_charge' => 0,
                    'total_amount' => $cart_items['total_amount'] + 0,
                );
               $cart_itm = new CartItem();
               $cart_itm->fill($cart_array);
               $cart_itm->save();
            }

            $order = new Order();
            $vat = $sub_total * 0.13;
            $order_item = array(
                'cart_id' => $cart_id,
                'user_id' => $request->user()->id,
                'sub_amount' => $sub_total,
                'vat_amount' => $vat,
                'delivery_charge' => 0,
                'total_amount' => $sub_total+$vat+0,
                'status' => 'new'
            );

            $order->fill($order_item);
            $order->save();
            session()->forget('cart');
            $request->session()->flash('success','Thank you for using our ecommerce. Your order has been placed. You will be shortly notify about your order staus.');
            return redirect()->route('user');
        }else{
            return redirect()->back();
        }
    }

    public function addToCart(Request $request){
       // dd($request->all());
        $this->product = $this->product->with('images')->find($request->product_id);

        $quantity = $request->quantity;

        $current_item =  array(
            'product_id' => $this->product->id,
            'title' => $this->product->title,
            'product_link' => route('product-detail',$this->product->slug),
            'image' => asset('uploads/product/Thumb-').$this->product->images[0]['image_name'],
            'price' => $this->product->price
        );
        $price = $this->product->price;
        if($this->product->discount > 0){
            $price = $price - (($price * $this->product->discount)/100);
        }

        $current_item['after_discount'] = $price;

       $cart = (session('cart') != null) ? session('cart') : array();


       if(!empty($cart)){
            $index = null;
            foreach ($cart as $key => $cart_items){
                if($cart_items['product_id'] == $this->product->id){
                    $index = $key;
                    break;
                }
            }

            if($index === null){
                $current_item['quantity'] = $quantity;
                $current_item['total_amount'] = $price * $quantity;
                $cart[] = $current_item;
            }else{
                $cart[$index]['quantity'] = $quantity;
                $cart[$index]['total_amount'] = $price * $quantity;
                if($quantity <= 0){
                    unset($cart[$index]);
                }
            }
       }else{
           $current_item['quantity'] = $quantity;
           $current_item['total_amount'] = $price * $quantity;
           $cart[] = $current_item;
       }

       session()->put('cart',$cart);
       return response()->json(['status'=>true,'msg'=>$this->product->title.' Updated in the cart']);

    }

}
