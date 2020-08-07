<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class PasswordController extends Controller
{
    //SHOW THE FORM FOR PASSWORD RESET
    public function index(){

        return view('passwords.index');

    }

    //RESET PASSWORD
    public function reset(Request $request){

        request()->validate([
            'Current_Password'  => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed']
        ]);

        if (Hash::check($request->Current_Password, Auth::user()->password)){

            $password = Hash::make($request->password);

            Auth::user()->update([
                'password' => $password
            ]);

            Session::flash('success', 'Password Reset Successfully');
            return redirect(route('home'));

        } else{

            Session::flash('error', 'Current Password is Incorrect');
            return redirect()->back();
        }

    }
}
