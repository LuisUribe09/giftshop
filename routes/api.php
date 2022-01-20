<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('profile', 'App\Http\Controllers\AuthController@profile');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
});

Route::get('/products', 'App\Http\Controllers\ProductsController@index');//show all products
Route::get('/products/{id}', 'App\Http\Controllers\ProductsController@show');//show an specific product
Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@showProductsByCategory');//show products by category
Route::post('/products', 'App\Http\Controllers\ProductsController@store');//create a record
Route::put('/products/{id}', 'App\Http\Controllers\ProductsController@update');//update a record
Route::delete('/products/{id}', 'App\Http\Controllers\ProductsController@destroy');//delete a record
Route::get('/category', 'App\Http\Controllers\CategoryController@index');//show all categories

