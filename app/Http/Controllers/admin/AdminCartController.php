<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Purchase;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Overtrue\LaravelShoppingCart\Facade as PurchaseCart;

class AdminCartController extends Controller
{


    public function purchase(Request $request){


        request()->validate([
           'product' => ['required'],
            'price'  => ['required'],
            'qty'    => ['required', 'numeric',]
        ]);

        $product = Product::findOrFail($request->product);
        $vendor = Vendor::findOrFail($request->vendor);
        PurchaseCart::associate('App\Product');

        //If item already in cart, redirect back
        if (!PurchaseCart::isEmpty()){
            foreach (PurchaseCart::all() as $check_duplicate){
                $chk_id = $check_duplicate->product->id;
                if ($chk_id == $product->id){
                    Session::flash('warning', 'Item is already in cart');
                    return redirect()->back();
                }
            }
        }

        //ADD NEW ITEM TO CART
        PurchaseCart::add(
         $product->id,
         $product->name,
         $request->qty,
         $request->price,
         ['vendor'=>$vendor->company, 'vendor_id'=>$vendor->id, 'payment_method'=>$request->payment_method, 'status'=>$request->status]
     );

    return redirect()->back();

    }


    //EDIT CART
    public function purchase_modify(Request $request, $purchase_id){

        request()->validate([
            'qty' => ['required', 'numeric']
        ]);

        if ($request->qty < 0){
            return redirect()->back();
        }

        PurchaseCart::update($purchase_id, $request->qty);
        return redirect()->back();

    }


 //REMOVE ITEM FROM CART
    public function purchase_remove($purchase_id){

        PurchaseCart::remove($purchase_id);
        return redirect()->back();

    }


    //PRINT PURCHASE
    public function print_purchase($vendor_id){

        $invoice = 'P-' . time();

        $vendor = Vendor::findOrFail($vendor_id);
        if (!PurchaseCart::isEmpty()){

            foreach (PurchaseCart::all() as $item) {

             //SAVE TO PURCHASES TABLE
                Purchase::create([
                    'product_id'     => $item->product->id,
                    'vendor_id'      => $item->vendor_id,
                    'invoice'        => $invoice,
                    'vendor'         => $item->vendor,
                    'category'       => $item->product->category,
                    'brand'          => $item->product->brand,
                    'name'           => $item->name,
                    'price'          => $item->price,
                    'qty'            => $item->qty,
                    'cost'           => $item->total,
                    'payment_method' => $item->payment_method,
                    'status'         => $item->status
                ]);

                //ADD QTY TO PRODUCTS TABLE IF STATUS IS RECEIVED
                if ($item->status == 'received'){
                    $product = Product::findOrFail($item->product->id);
                    $qty = $product->qty + $item->qty;
                    $product->update([
                       'qty' => $qty
                    ]);

                }

            }
        }

        Session::flash('success', 'Purchase Was Successful');
        return view('purchases.print_purchase', compact('vendor'));

    }


}
