<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
       return view('categories.index', compact('categories'));
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
    public function store(Request $request)
    {
        request()->validate([
            'name'=> ['required', 'min:3', 'max:255', 'unique:categories']
        ]);


         Category::create([
            'name' => ucwords(strtolower($request->name))
         ]);

         Session::flash('success', 'Category Created successfully');
         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $oldcat = $category->name;

        request()->validate([
            'name'=>['required', 'string', 'min:3', 'max:255', 'unique:categories']
        ]);

        $category->update([
            'name' => ucwords(strtolower($request->name))
        ]);

        //Update in Products Table
        $products = Product::where('category', $oldcat)->get();
        foreach ($products as $product){
            $product->update([
                'category' => $request->name
            ]);
        }


        Session::flash('success', 'Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();
        Session::flash('success', 'Category deleted successfully');
        return redirect()->back();
    }
}
