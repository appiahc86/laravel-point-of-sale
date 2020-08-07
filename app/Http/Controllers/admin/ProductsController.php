<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\SaveProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::all();
        $less_count = Product::where('qty', '<', 5)->count();
        return view('products.index')->with('products', $products)->with('less_count', $less_count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProductRequest $request)
    {
        $profit = $request->retail_price - $request->cost_price;

       Product::create([
           'category' => $request->category,
           'brand' => ucwords(strtolower($request->brand)),
           'name' => ucwords(strtolower($request->product_name)),
           'cost_price' => $request->cost_price,
           'wholesale_price' => $request->wholesale_price,
           'selling_price' => $request->retail_price,
           'profit' => $profit,
           'qty' => $request->quantity
       ]);


       Session::flash('success', 'Product Saved');
       return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $profit = $request->selling_price - $request->cost_price;
        $qty = $request->qty + $request->addqty;

        $product->update([
             'category' => $request->category,
             'brand' => ucwords(strtolower($request->brand)),
             'name' => ucwords(strtolower($request->name)),
             'cost_price' => $request->cost_price,
             'wholesale_price' => $request->wholesale_price,
             'selling_price' => $request->selling_price,
             'profit' => $profit,
             'qty' => $qty
         ]);

        Session::flash('success', 'Product Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product->delete();
        Session::flash('success', 'Product Deleted');
        return redirect()->back();
    }
}
