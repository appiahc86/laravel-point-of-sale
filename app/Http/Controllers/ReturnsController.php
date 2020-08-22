<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReturnsController extends Controller
{
    //DISPLAY THE SEARCH FORM
   public function index(){
       return view('returns.index');
   }

//SEARCH ORDERS BY INVOICE NUMBER
    public function search(Request $request){

      request()->validate([
         'invoice' => ['required']
      ]);

      $orders = Order::where('invoice', $request->invoice)->get();

      if ($orders->count() == 0){
          Session::flash('warning', 'The Invoice Number Does not Exist');
          return redirect()->back();
      }

       return view('returns.index', compact('orders'));
    }


    //RETURN PRODUCTS
    public function return(Request $request){

       request()->validate([
          'select' => ['required']
       ]);

       $change = 0;

       if (isset($_POST['checkboxarray'])){
           foreach ($_POST['checkboxarray'] as $checkboxvalue){
               $select = $request->select;
               if ($select == 'return'){

                   $order = Order::findOrFail($checkboxvalue); //Find by order ID
                   $product = Product::findOrFail($order->product_id); //Find the Product
                   $prod_qty = $product->qty + $order->qty;

                   //Get change for the customer
                    $change += $order->amount;

                   $product->update([  //Add quantity to products table
                      'qty' => $prod_qty
                   ]);

                  $order->delete();


               } // ./$select == 'return'
           } // ./Foreach Loop
       } // ./$_POST['checkboxarray']

       else{
           Session::flash('fail_return', 'Sorry!!!, You did not Select item to return');
           return redirect(route('returns'));
       }

       Session::flash('change', $change);
       return redirect(route('returns'));

    }


}
