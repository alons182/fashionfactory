<?php
//Auth::loginUsingId(1);
# Bind Repos
App::bind('Fashion\Repos\User\UserRepository', 'Fashion\Repos\User\DbUserRepository');
App::bind('Fashion\Repos\Category\CategoryRepository', 'Fashion\Repos\Category\DbCategoryRepository');
App::bind('Fashion\Repos\Product\ProductRepository', 'Fashion\Repos\Product\DbProductRepository');
App::bind('Fashion\Repos\Photo\PhotoRepository', 'Fashion\Repos\Photo\DbPhotoRepository');
# Session
Route::get('admin/login', ['as'=> 'login', 'uses'=>'SessionsController@create']);
Route::post('admin/login', ['as'=> 'sessions.store', 'uses'=>'SessionsController@store']);
Route::get('admin/logout', ['as'=> 'logout', 'uses'=>'SessionsController@destroy']);

# reset password
Route::get('password_resets/reset/{token}', 'PasswordResetsController@reset');
Route::post('password_resets/reset/{token}', 'PasswordResetsController@postReset');
Route::resource('password_resets', 'PasswordResetsController');

Route::group(['prefix' => 'admin', 'before' => 'auth.admin'], function()
{

# Dashboard
Route::get('/', ['as'=> 'admin', 'uses'=>'App\Controllers\Admin\DashboardController@index']);

# Users
Route::get('users', ['as'=> 'users', 'uses'=>'App\Controllers\Admin\UsersController@index']);
Route::get('users/register', ['as'=> 'user_register', 'uses'=>'App\Controllers\Admin\UsersController@create']);
Route::post('users/register', ['as'=> 'user_register.store', 'uses'=>'App\Controllers\Admin\UsersController@store']);
Route::resource('users', 'App\Controllers\Admin\UsersController');

# categories
foreach (['up', 'down','pub', 'unpub','feat','unfeat'] as $key) 
    {    
        Route::post("categories/{category}/$key", array(
            'as' => "categories.$key",
            'uses' => "App\Controllers\Admin\CategoriesController@$key",
        ));
    }
Route::resource('categories', 'App\Controllers\Admin\CategoriesController');

# products       

foreach (['pub', 'unpub'] as $key) 
    {    
        Route::post("products/{product}/$key", array(
            'as' => "products.$key",
            'uses' => "App\Controllers\Admin\ProductsController@$key",
        ));
    }
Route::post('products/delete', ['as'=> 'destroy_multiple', 'uses'=>'App\Controllers\Admin\ProductsController@destroy_multiple']);
Route::resource('products', 'App\Controllers\Admin\ProductsController');

Route::post('photos', ['as' => 'save_photo', 'uses' => 'App\Controllers\Admin\PhotosController@store']);
Route::post('photos/{photo}', ['as' => 'delete_photo', 'uses' => 'App\Controllers\Admin\PhotosController@destroy']);
//Route::resource('photos', 'App\Controllers\Admin\PhotosController');

});

# pages  
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);
Route::get('about', ['as' => 'about', 'uses' => 'PagesController@about']);
Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@contact']);
Route::post('contact', ['as' => 'contact.store', 'uses' => 'PagesController@postContact']);
# categories
Route::get('categories', ['as' => 'categories', 'uses' => 'CategoriesController@index']);
Route::get('categories/{category}', ['as' => 'category', 'uses' => 'CategoriesController@show']);

# products  
Route::get('categories/{category}/products', ['as' => 'products', 'uses' => 'ProductsController@index']);
Route::get('categories/{category}/products/{product}', ['as' => 'product', 'uses' => 'ProductsController@show']);
Route::get('search', ['as' => 'products_search', 'uses' => 'ProductsController@search']);


	
