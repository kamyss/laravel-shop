<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [
    'uses'=>'HomeController@index',
]);


///////////////////////////////////后台路由///////////////////////////////////////////////////////
Route::group(['middleware' => 'rbac:permission,admin.index'], function () {
    $AdminNamespace = '\\App\\Admin\\Http\\Controllers\\';
    Route::get('/admin', $AdminNamespace.'DashboardController@index')->name('admin.index');

    Route::resource('admin/adminuser',$AdminNamespace.'AdminUserController');

    Route::any('admin/adminuser/attachRoles/{id}',$AdminNamespace.'AdminUserController@attachRoles')->name('adminuser.attachRoles');

    Route::resource('admin/permission',$AdminNamespace.'PermissionController');

    Route::resource('admin/role',$AdminNamespace.'RoleController');

    Route::any('admin/role/attachPermissions/{id}',$AdminNamespace.'RoleController@attachPermissions')->name('role.attachPermissions');

    Route::get('admin/menu',$AdminNamespace.'MenuController@index')->name('menu.index');
    Route::get('admin/menu/create',$AdminNamespace.'MenuController@create')->name('menu.create');
    Route::post('admin/menu/store',$AdminNamespace.'MenuController@store')->name('menu.store');
    Route::get('admin/menu/{id}/edit',$AdminNamespace.'MenuController@edit')->name('menu.edit');
    Route::post('admin/menu/{id}/update',$AdminNamespace.'MenuController@update')->name('menu.update');
    Route::get('admin/menu/{id}/delete',$AdminNamespace.'MenuController@delete')->name('menu.delete');


    Route::get('admin/shop/category',$AdminNamespace.'CategoryController@index')->name('category.index');
    Route::get('admin/shop/category/create',$AdminNamespace.'CategoryController@create')->name('category.create');
    Route::post('admin/shop/category/store',$AdminNamespace.'CategoryController@store')->name('category.store');
    Route::get('admin/shop/category/{id}/edit',$AdminNamespace.'CategoryController@edit')->name('category.edit');
    Route::post('admin/shop/category/{id}/update',$AdminNamespace.'CategoryController@update')->name('category.update');
    Route::get('admin/shop/category/{id}/delete',$AdminNamespace.'CategoryController@delete')->name('category.delete');
    Route::any('admin/shop/category/order',$AdminNamespace.'CategoryController@order')->name('category.order');


    Route::get('admin/shop/product',$AdminNamespace.'ProductController@index')->name('product.index');
    Route::any('admin/shop/product/create',$AdminNamespace.'ProductController@create')->name('product.create');
    Route::post('admin/shop/product/store',$AdminNamespace.'ProductController@store')->name('product.store');
    Route::get('admin/shop/product/{id}/delete',$AdminNamespace.'ProductController@delete')->name('product.delete');
    Route::get('admin/shop/product/{id}/edit',$AdminNamespace.'ProductController@edit')->name('product.edit');
    Route::post('admin/shop/product/{id}/update',$AdminNamespace.'ProductController@update')->name('product.update');



    Route::post('admin/plug/uploadFile',$AdminNamespace.'PlugController@uploadFile')->name('plug.upload');


});

///////////////////////////////////后台路由///////////////////////////////////////////////////////