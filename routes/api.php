<?php

use Illuminate\Http\Request;
Use App\Category;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


 //categories
Route::get('categories','\App\Http\Controllers\API\CategoryController@index');

 //posts
Route::get('posts','\App\Http\Controllers\API\PostsController@posts');
//post
Route::get('post','\App\Http\Controllers\API\PostsController@post');




//user
Route::get('users/info','\App\Http\Controllers\API\UserController@index');
Route::post('users/login','\App\Http\Controllers\API\UserController@login');
Route::get('users/register','\App\Http\Controllers\API\UserController@register');
Route::post('users/update_profile','\App\Http\Controllers\API\UserController@update');
Route::delete('user/{id}','\App\Http\Controllers\API\UserController@destroy');