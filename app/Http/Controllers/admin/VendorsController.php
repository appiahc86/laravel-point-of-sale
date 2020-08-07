<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddVendorRequest;
use App\Http\Requests\EditVendorRequest;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
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
    public function store(AddVendorRequest $request)
    {
        Vendor::create([
            'company'         => strtoupper(strtolower($request->company)),
            'contact_person'  => ucwords(strtolower($request->contact_person)),
            'phone'           => $request->phone,
            'company_address' => ucwords(strtolower($request->address))
        ]);

        Session::flash('success', 'New Vendor Added');
        return redirect()->back();
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(EditVendorRequest$request, Vendor $vendor)
    {
        $vendor->update([
            'company'         => strtoupper(strtolower($request->company)),
            'contact_person'  => ucwords(strtolower($request->contact_person)),
            'phone'           => $request->phone,
            'company_address' => ucwords(strtolower($request->company_address))
        ]);

        Session::flash('success', 'Vendor Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
       $vendor->delete();
       Session::flash('success', 'Vendor Deleted');
       return redirect()->back();
    }
}
