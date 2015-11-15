<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('home', function() {
//     return view('home');
// });

// Route::get('home', ['middleware' => 'admin', function () {
//     $user = Auth::user();
//     $email = $user->email;
//     $name = $user->name;
//     //return view('home', ['name' => $name, 'email' => $email]);
//     return view('home', compact('name', 'email'));

// }]);
//
Route::get('home', [
    'as' => 'categories', 'uses' => 'ProductsController@index'
    ]);


// Route::get('products', 'ProductsController@index');
// Route::get('products/create', 'ProductsController@create');
// Route::get('products/{id}', 'ProductsController@show');
// Route::post('products', 'ProductsController@store');
// Route::delete('products/{id}', 'ProductsController@destroy');
// Route::delete('products/{id}/edit', 'ProductsController@edit');
Route::resource('products', 'ProductsController');

Route::get('categories', 'CategoriesController@index');
Route::get('categories/create', 'CategoriesController@create');
Route::get('categories/{id}', 'CategoriesController@show');
Route::post('categories', 'CategoriesController@store');

Route::get('tags', 'TagsController@index');
Route::get('tags/create', 'TagsController@create');
Route::get('tags/{id}', 'TagsController@show');
Route::post('tags', 'TagsController@store');


// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('users', 'UsersController@index');
Route::get('users/{id}', 'UsersController@show');

Route::controllers([
    'password' => 'Auth\PasswordController',
    ]);

