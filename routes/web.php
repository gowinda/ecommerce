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

Route::get('/', 'FrontendController@homePage')->name('homepage');

/* Static Page*/
Route::get('/{slug}.html','PageController@getPageDetail')->name('page-detail');
Route::get('/signup','FrontendController@showRegisterForm')->name('signup');

Route::get('/products','ProductController@getAllProducts')->name('all-products');

Route::get('/featured-products','ProductController@getAllFeaturedProducts')->name('featured-products');

Route::get('/category/{slug}','CategoryController@getAllCategoryProducts')->name('cat-product');
Route::get('/category/{parent_slug}/{slug}','CategoryController@getAllSubCategoryProducts')->name('sub-cat-product');

Route::get('/contact-us','FrontendController@contactusPage')->name('contact-us');
Route::post('/contact-us','FrontendController@contactSubmit')->name('send-contact');

Route::get('/search','ProductController@getSearchResult')->name('search');

Route::get('/product/{slug}','ProductController@show')->name('product-detail');
Route::post('/user/register','UserController@registerUser')->name('signup-process');
Route::post('/product/{id}/review','ProductController@storeReview')->name('review-product')->middleware(['auth','user']);
Route::post('/cart/add','CartController@addToCart')->name('add-to-cart');

Route::get('/cart','CartController@showCart')->name('cart');
Route::get('/checkout','CartController@checkout')->name('checkout')->middleware(['auth','user']);

/* Static Page*/

Route::group(['prefix'=>'admin', 'middleware' => ['auth','admin']], function (){
    Route::get('/', 'HomeController@admin')->name('admin');

    Route::resource('slider','SliderController')->except('show');
    Route::resource('category','CategoryController')->except('show');
    Route::resource('product','ProductController');
    Route::resource('page','PageController')->except(['create','store','show','destroy']);

});

Route::post('/category/get-child','CategoryController@getChildCategory')->name('get-child');

Route::group(['prefix'=>'seller', 'middleware' => ['auth','seller']], function (){
    Route::get('/', 'HomeController@seller')->name('seller');
});

Route::group(['prefix'=>'user', 'middleware' => ['auth','user']], function (){
    Route::get('/', 'HomeController@user')->name('user');
});

Route::get('/{role}/change-password','UserController@showChangepasswordForm')->name('change-password');
Route::post('/{role}/change-password','UserController@savepassword')->name('save-password');


Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
