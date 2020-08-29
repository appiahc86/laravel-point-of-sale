<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Add company
Route::get('/company/add', 'CompanyController@index')->name('add-company');
Route::post('/company/store', 'CompanyController@store')->name('store-company');


Route::get('/', 'HomeController@index')->name('home'); //Protected by Auth Already

Route::get('/close', 'HomeController@close')->name('close-app');

Auth::routes(['verify'=>false, 'reset'=>false]);


                      //Admin Middleware
Route::group(['middleware'=>['auth', 'admin']], function (){
    //EDIT COMPANY
    Route::get('/company/edit/{company}', 'CompanyController@edit')->name('edit-company');
    Route::patch('/company/update/{company}', 'CompanyController@update')->name('update-company');

    //USERS
    Route::resource('admin/users', 'admin\UsersController');

    //PRODUCTS
    Route::resource('/admin/products', 'admin\ProductsController');

    //CATEGORIES
    Route::resource('/admin/category', 'admin\CategoriesController');

    //Vendors
    Route::resource('/admin/vendors', 'admin\VendorsController');

    //PURCHASES
    //LIST ALL AVAILABLE VENDORS
    Route::get('admin/purchase', function (){
        $vendors = \App\Vendor::all();
        return view('purchases.index', compact('vendors'));
    });
    //SHOW PURCHASE ORDER FORM
    Route::get('admin/purchase/{vendor}', 'admin\PurchaseController@show')->name('admin.purchase.show');

    // ADD ITEM TO CART
    Route::post('admin/purchases/cart', 'admin\AdminCartController@purchase')->name('admin.purchase');
    //REMOVE ITEM FROM CART
    Route::post('admin/purchases/cart/remove/{purchase_id}', 'admin\AdminCartController@purchase_remove')->name('admin.purchase.remove');
    //MODIFY CART
    Route::post('admin/purchases/cart/modify/{purchase_id}', 'admin\AdminCartController@purchase_modify')->name('admin.purchase.modify');
    //SHOW THE VIEW TO PRINT PURCHASE INVOICE
    Route::get('admin/purchase/print/{vendor_id}', 'admin\AdminCartController@print_purchase')->name('print.purchase');
    //SHOW PURCHASE ORDERS
    Route::get('admin/purchase/order/lists', 'admin\PurchaseController@purchase_order_list')->name('purchase.order.list');
    //RECEIVE PURCHASE ORDER
    Route::post('admin/purchase/receive/{purchase}', 'admin\PurchaseController@receive')->name('purchase.receive');
    //CANCEL PURCHASE ORDER
    Route::post('admin/purchase/cancel/{purchase}', 'admin\PurchaseController@cancel')->name('purchase.cancel');


});
//END OF ADMIN **************************************



                                    //Auth Routes
Route::group(['middleware'=>['auth']], function (){

    //USERS
    Route::get('/user/password/reset', 'PasswordController@index')->name('passwords');
    Route::post('/user/password/reset', 'PasswordController@reset')->name('passwords.reset');

//SALES
    Route::get('/sales', function (){
        return view('sales');
    });

    Route::post('/sales', 'CartController@add')->name('add_to_cart');
    Route::post('/cart/modify/{product}', 'CartController@modify')->name('cart-modify');
    Route::post('/sales/{product}', 'CartController@remove')->name('remove_from_cart');
    Route::post('/cart/pay', 'CartController@pay')->name('cart_pay');

//RETURNS
    Route::get('/sales/returns', 'ReturnsController@index')->name('returns');
    Route::post('/sales/returns/search', 'ReturnsController@search')->name('return.search');
    Route::post('/sales/returns/item', 'ReturnsController@return')->name('return.return');


//REPORTS
              //SALES
    Route::get('/reports/daily/sales', 'ReportController@daily_sale')->name('daily_sale');
    Route::get('/reports/sales/report', 'ReportController@sales_report_by_date')->name('sales_report_by_date');
    Route::post('/reports/sales/report', 'ReportController@sales_by_date')->name('sales_by_date');
             //PRODUCTS
    Route::get('/reports/products/lists', 'ReportController@products_lists')->name('products_lists');
            //PURCHASES
    Route::get('/report/purchases/report', 'ReportController@purchases_report_by_date')->name('purchases_report_by_date');
    Route::post('/report/purchases/report', 'ReportController@purchases_by_date')->name('purchases_by_date');
    Route::get('/report/open/purchases/report', 'ReportController@open_purchases')->name('open_purchases');

    //BACKUP DATABASE
    Route::get('/backup', 'BackupController@index')->name('backup');

});
    //./AUTH ROUTES
