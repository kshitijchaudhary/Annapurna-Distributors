<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| 
|
*/
 
Route::get('/', 'site\mainController@index');
Route::get('/product/{product_id}', 'site\mainController@singleProduct');
Route::get('/category/{subcat_id}/{subcatname}', 'site\mainController@subcatProduct');
Route::post('/add-to-cart', 'site\mainController@addToCart')->middleware(['auth']);
Route::get('/cart', 'site\mainController@cart')->middleware(['auth']);
Route::get('/cart/remove/{cart_id}', 'site\mainController@removeCart')->middleware(['auth']);
Route::get('/cart/order-info', 'site\mainController@cartOrderInfo')->middleware(['auth']);
Route::post('/cart/confirm-order', 'site\mainController@cartOrderConfirm')->middleware(['auth']);
 

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', 'auth\AuthController@registerIndex');
Route::post('/register', 'auth\AuthController@register');

Route::get('/login', 'auth\AuthController@loginIndex')->name('login'); 
Route::post('/login', 'auth\AuthController@login');
Route::get('/logout', 'auth\AuthController@logout')->middleware(['auth']);

Route::get('/verify-your-email', 'auth\AuthController@verifyEmailView');
Route::get('/verify-email', 'auth\AuthController@verifyEmail');
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/ 
//register admin
Route::get('/register-admin', 'auth\AuthController@registerAdmin');


Route::middleware(['auth', 'checkifadmin'])->group(function () {
 
    Route::get('/dashboard', 'Dashboard\MainController@index');
  

    Route::get('/dashboard/products', 'Dashboard\ProductController@index');
    Route::post('/dashboard/product/add', 'Dashboard\ProductController@add');
    Route::get('/dashboard/product/view/{product_id}', 'Dashboard\ProductController@view');
    Route::post('/dashboard/product/edit', 'Dashboard\ProductController@edit');
    Route::get('/dashboard/product/remove/{product_id}', 'Dashboard\ProductController@remove');



    Route::get('/dashboard/categories', 'Dashboard\CategoryController@index');
    Route::post('/dashboard/categories/add', 'Dashboard\CategoryController@add');
    Route::post('/dashboard/categories/remove', 'Dashboard\CategoryController@remove');


    Route::post('/dashboard/sub-categories/add', 'Dashboard\CategoryController@addSubCat');
    Route::get('/dashboard/sub-categories/remove/{subcat_id}', 'Dashboard\CategoryController@removeSubCat');


    Route::get('/dashboard/orders', 'Dashboard\OrderController@index');
    Route::get('/dashboard/order/view/{user_id}', 'Dashboard\OrderController@orderView');
    Route::get('/dashboard/order/{user_id}/complete', 'Dashboard\OrderController@markOrderComplete');
    Route::get('/dashboard/order/{user_id}/incomplete', 'Dashboard\OrderController@markOrderIncomplete');
    Route::get('/dashboard/order/{user_id}/cancel-order', 'Dashboard\OrderController@cancelOrder');

    Route::get('/dashboard/user', 'Dashboard\MainController@usersView');

});
