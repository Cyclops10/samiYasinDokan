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

Route::get('/', function () {return view('index'); } )->name('index');
Route::get('/wishlist', function () {return view('index'); } )->name('wishlist');
Route::get('/checkout', function () {return view('index'); } )->name('checkout');
Route::get('/cart', function () {return view('cart'); } )->name('cart');
Route::get('/product/{id}', function () {return view('product'); });

//Route::get('/', 'CategoriesController@getIndex')->name('categories');

//Start Front Route

/*Route::get('/', function () { return view('index'); });
Route::get('/home', function () { return view('index'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/services', function () { return view('services'); })->name('services');
Route::get('/work', function () { return view('work'); })->name('work');
Route::get('/work-details', function () { return view('work-details'); })->name('work-details');
Route::get('/contact', function () { return view('contact'); })->name('contact');*/

//End Fornt Route

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//*****Start Category Path*****
Route::get('/admin/category', ['uses'=>'CategoriesController@index','as'=>'admin_category','middleware'=>'roles','roles'=>'admin']);
Route::post('/admin/category', ['uses'=>'CategoriesController@catCreate','as'=>'admin_category_post','middleware'=>'roles','roles'=>'admin']);

Route::get('/admin/category/{id}/edit', ['uses'=>'CategoriesController@catEditShow','as'=>'admin_category_edit_show','middleware'=>'roles','roles'=>'admin']);
Route::post('/admin/category/{id}/edit', ['uses'=>'CategoriesController@catEdit','as'=>'admin_category_edit','middleware'=>'roles','roles'=>'admin']);

Route::get('/admin/category/{id}/delete', ['uses'=>'CategoriesController@catDestroy','as'=>'admin_category_delete','middleware'=>'roles','roles'=>'admin']);
//*****End Category Path*****

//*****Start Element Path*****
Route::get('/admin/element', ['uses'=>'ElementsController@index','as'=>'admin_element','middleware'=>'roles','roles'=>'admin']);
Route::post('/admin/element', ['uses'=>'ElementsController@eleCreate','as'=>'admin_element_post','middleware'=>'roles','roles'=>'admin']);

Route::get('/admin/element/{id}/edit', ['uses'=>'ElementsController@eleEditShow','as'=>'admin_element_edit_show','middleware'=>'roles','roles'=>'admin']);
Route::post('/admin/element/{id}/edit', ['uses'=>'ElementsController@eleEdit','as'=>'admin_element_edit','middleware'=>'roles','roles'=>'admin']);

Route::get('/admin/element/{id}/delete', ['uses'=>'ElementsController@eleDestroy','as'=>'admin_element_delete','middleware'=>'roles','roles'=>'admin']);
//*****End Element Path*****


//*****Start Product Path*****
Route::get('/admin/product/', ['uses'=>'ProductsController@productListView','as'=>'admin_product_list','middleware'=>'roles','roles'=>'admin']);

Route::get('/admin/product/add', ['uses'=>'ProductsController@showForm','as'=>'admin_product','middleware'=>'roles','roles'=>'admin']);
Route::post('/admin/product/add', ['uses'=>'ProductsController@proCreate','as'=>'admin_product_post','middleware'=>'roles','roles'=>'admin']);

Route::get('/admin/product/{id}/edit', ['uses'=>'ProductsController@proEditShow','as'=>'admin_product_edit_show','middleware'=>'roles','roles'=>'admin']);
Route::post('/admin/product/{id}/edit', ['uses'=>'ProductsController@proEdit','as'=>'admin_product_edit','middleware'=>'roles','roles'=>'admin']);

Route::get('/admin/product/{id}/delete', ['uses'=>'ProductsController@proDestroy','as'=>'admin_product_delete','middleware'=>'roles','roles'=>'admin']);

Route::post('/admin/product/cat-element', ['uses'=>'ProductsController@proCatElement','as'=>'admin_product_cat_element','middleware'=>'roles','roles'=>'admin']);


//*****End Product Path*****


Route::get('admin/dashboard',['uses'=>'HomeController@fake','as'=>'admin-dashboard','middleware'=>'roles','roles'=>'admin']);

Route::get('seller/dashboard',['uses'=>'HomeController@fake','as'=>'seller-dashboard','middleware'=>'roles','roles'=>'seller']);

Route::get('user/dashboard',['uses'=>'HomeController@fake','as'=>'user-dashboard','middleware'=>'roles','roles'=>'user']);

/*Route::post('/categories',
    [   'uses'=>'CategoriesController',
        'as'=>'categories',
        'middleware'=>'roles',
        'roles'=> ['admin','seller']
    ])->name('categories');*/