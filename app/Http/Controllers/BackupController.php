<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class BackupController extends Controller
{
    //Backup Database
    public function index(){

           shell_exec('start C:\xampp\htdocs\laravel-point-of-sale\backup.bat');

           echo  "<script>
                    alert('Backup was successful');
                    document.write(`<h1 style=\"text-align: center; color:red; font-size: 3em; padding-top: 100px;\">Please Wait....</h1>`);
                    window.location.href='/';
                </script>";

    }


}
