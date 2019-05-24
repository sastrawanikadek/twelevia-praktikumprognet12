<?php

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
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@adminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@adminRegisterForm');
Route::get('/home', 'HomeController@index');
Route::get('/admin/dashboard', 'DashboardController@index');
Route::get('/', 'PageController@home');
Route::get('/shop', 'PageController@shop');
Route::get('/shop/{type}/{category}', 'PageController@shopByCategory');
Route::get('/checkout', 'PageController@checkout');
Route::get('/profile', 'HomeController@profile');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@adminRegister');
Route::post('/logout/admin', function(){
    Auth::guard('admin')->logout();
    return redirect()->intended('/login/admin');
});
Route::post('/cart', 'CartController@store');
Route::post('/shipping', 'PageController@calculateShipping');
Route::post('/checkout', 'PageController@checkoutProduct');

Route::delete('/cart/{id}', 'CartController@destroy');

Route::resource('/admin/product', 'ProductController');
Route::resource('/admin/product-image', 'ProductImageController');
Route::resource('/admin/courier', 'CourierController');
Route::resource('/admin/category', 'CategoryController');
Route::resource('/admin/discount', 'DiscountController');