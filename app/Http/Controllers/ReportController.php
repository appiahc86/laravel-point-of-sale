<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //DAILY SALES
    public function daily_sale(){

        $orders = Order::whereDate('created_at', date('y-m-d'))->get();
        return view('reports.daily_sales')->with('orders', $orders);
    }

    //SALES REPORT BY DATE PAGE
    public function sales_report_by_date(){
        return view('reports.sales_report_by_date');
    }

    //SALES REPORT BY DATE SEARCH
    public function sales_by_date(Request $request){

       request()->validate([
          'from' => 'required',
          'to'   => 'required'
       ]);

       $from = strtotime($request->from);
       $from = date('d-M-Y', $from);

       $to = strtotime($request->to);
       $to = date('d-M-Y', $to);

       $orders = Order::whereDate('created_at', '>=', $request->from)
                 ->whereDate('created_at', '<=', $request->to)->get();

        return view('reports.sales_report_by_date', compact('orders', 'from', 'to'));
    }

   //PRODUCTS LISTS
    public function products_lists(){

        $products = Product::all();
        return view('reports.products_lists')->with('products', $products);

    }

              //PURCHASES
//LIST ALL PURCHASES
public function purchases_report_by_date(){
        return view('reports.purchase_by_date');
}
//PURCHASES SEARCH
public function purchases_by_date(Request $request){
    request()->validate([
        'from' => 'required',
        'to'   => 'required'
    ]);

    $from = strtotime($request->from);
    $from = date('d-M-Y', $from);

    $to = strtotime($request->to);
    $to = date('d-M-Y', $to);

    $purchases = Purchase::whereDate('created_at', '>=', $request->from)
        ->whereDate('created_at', '<=', $request->to)
        ->where('status', 'received')
        ->get();
    return view('reports.purchase_by_date', compact('purchases', 'from', 'to'));

}

//OPEN PURCHASES LIST
    public function open_purchases(){

        $purchases = Purchase::where('status', 'open')->get();
        return view('reports.open_purchases', compact('purchases'));

    }


}
