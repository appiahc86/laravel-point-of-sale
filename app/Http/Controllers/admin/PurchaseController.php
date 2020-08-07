<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Purchase;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PurchaseController extends Controller
{
   public function show(Vendor $vendor){

       return view('purchases.purchase', compact('vendor'));
   }

   //LIST ALL PURCHASES IN THE VIEW
   public function purchase_order_list(){
      $purchases = Purchase::all();
       return view('purchases.purchase_order_list', compact('purchases'));

   }

   //RECEIVE PURCHASED ITEM
  public function receive(Purchase $purchase){

       //ADD QTY TO PRODUCTS TABLE
      $product = Product::findOrFail($purchase->product_id);
      $qty = $product->qty + $purchase->qty;
      $product->update([
          'qty' => $qty
      ]);

      //SET STATUS TO 'RECEIVED' IN PURCHASES TABLE
        $purchase->update([
            'status' => 'received'
        ]);

        Session::flash('success', 'Received Successfully');
        return redirect()->back();
  }

  //CANCEL PURCHASE ORDER
    public function cancel(Purchase $purchase){
       $purchase->delete();
       return redirect()->back();
    }

}
