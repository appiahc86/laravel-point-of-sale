<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Overtrue\LaravelShoppingCart\Facade as Cart;

class CartController extends Controller
{
    //ADD ITEM TO CART
   public function add(Request $request){

       $product = Product::findOrFail($request->product);
       Cart::associate('App\Product');

    //If item already in cart, redirect back
       if (!Cart::isEmpty()){
           foreach (Cart::all() as $check_duplicate){
               $chk_id = $check_duplicate->product->id;
              if ($chk_id == $product->id){
                  Session::flash('warning', 'Item is already in cart');
                  return redirect()->back();
              }
           }
       }

       $price = $product->selling_price;
       if ($request->price_level == 'wholesale'){
           $price = $product->wholesale_price;
       }
       $amount = ($request->qty * $price) - $request->discount;
       $profit = (($price * $request->qty) - ($product->cost_price * $request->qty)) - $request->discount;


       Cart::add(
           $product->id,
           $product->name,
           $request->qty,
           $price,
           ['discount'=>$request->discount, 'amount'=>$amount, 'profit'=>$profit, 'price_level'=>$request->price_level, 'brand'=>$product->brand]
       );

       return redirect()->back();

   }

   //MODIFY CART ITEMS
    public function modify(Request $request, $product){

       request()->validate([
           'qty' => ['numeric']
       ]);

       //IF INPUT QTY IS LESS THAN ZERO, REDIRECT BACK
        if ($request->qty < 0){
            return redirect()->back();
        }

        //Get Item From Cart
        $find_from_db = Cart::get($product);

       //Calculate Discount
       $amount = ($request->qty * $request->price) - $find_from_db->discount;

        //Calculate the profit
        $profit = (($request->price * $request->qty) - ($find_from_db->product->cost_price * $request->qty)) - $find_from_db->discount;

       Cart::update($product, ['qty'=>$request->qty, 'amount'=>$amount, 'profit'=>$profit]);


       //REMOVE ITEM IF QTY IS 0
       $cart_item = Cart::get($product);
       if ($cart_item->qty == 0){
           Cart::remove($product);
       }
       return redirect()->back();

    }

//REMOVE ITEM FROM CART
   public function remove($product){
       Cart::remove($product);
       return redirect()->back();
   }

//TAKE PAYMENT
   public function pay(Request $request){

       if (!Cart::isEmpty()){
           $invoice = time();
           $tendered = $request->price;
           $customer = $request->cust_name;
           foreach (Cart::all() as $product){

             // Save to Orders Table
               Order::create([
                   'product_id'    => $product->product->id,
                   'invoice'       => $invoice,
                   'price_level'   => $product->price_level,
                   'category'      => $product->product->category,
                   'brand'         => $product->brand,
                   'name'          => $product->name,
                   'cost_price'    => $product->product->cost_price,
                   'selling_price' => $product->price,
                   'qty'           => $product->qty,
                   'discount'      => $product->discount,
                   'amount'        => $product->amount,
                   'profit'        => $product->profit
               ]);

               //Deduct qty from products table
               $item = Product::findOrFail($product->product->id);
               $new_qty = $item->qty - $product->qty;
               $item->update([
                   'qty' => $new_qty
               ]);


           }
           return view('payment', compact('invoice', 'tendered', 'customer'));
       }
       return redirect()->back();


}



}
