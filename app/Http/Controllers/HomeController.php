<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('close');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales = \App\Order::whereDate('created_at', date('y-m-d'))->sum('amount');
        return view('index', compact('sales'));
    }


    public function close(){

        //  turn this code off
    //    if (PHP_OS == 'Linux') {
    //        exec('pkill --oldest chrome');
    //    }else{
    //        exec('taskkill /F /IM chrome.exe');
    //    }

    }

}
