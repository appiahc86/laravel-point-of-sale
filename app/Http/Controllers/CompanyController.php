<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function index(){
        if (Auth::user() || Company::all()->count() > 0){
            return redirect()->back();
        }
        return view('company.add');
    }


    public function store(Request $request){
        $request->validate([
           'name' => ['required', 'min:5', 'max:150'],
           'address' => ['required', 'min:5', 'max:255'],
           'contact' => ['required', 'min:5', 'max:150'],
        ]);

        Company::create([
           'name' => $request->name,
           'address' => $request->address,
           'contact' => $request->contact
        ]);

        return redirect(route('login'));

    }

    public function edit(Company $company){
        return view('company.edit', compact('company'));
    }

    public function update(Request $request, Company $company){
        $request->validate([
            'name' => ['required', 'min:5', 'max:150'],
            'address' => ['required', 'min:5', 'max:255'],
            'contact' => ['required', 'min:5', 'max:150'],
        ]);

        $company->update([
           'name'=> $request->name,
           'address' => $request->address,
           'contact' => $request->contact
        ]);

        Session::flash('success', 'Record Was Modified Successfully');
        return redirect(route('home'));
    }
}
