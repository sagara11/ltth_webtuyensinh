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
Route::get('posts/search','\App\Http\Controllers\API\PostsController@search');
//post
Route::get('post','\App\Http\Controllers\API\PostsController@post');
//user
Route::get('users/info','\App\Http\Controllers\API\UserController@index');
Route::post('users/login','\App\Http\Controllers\API\UserController@login');
Route::post('users/login_social','\App\Http\Controllers\API\UserController@login_social');
Route::post('users/update_profile','\App\Http\Controllers\API\UserController@update');
Route::get('users/comments','\App\Http\Controllers\API\UserController@comments');
Route::get('users/test','\App\Http\Controllers\API\UserController@test_login');
Route::post('users/forgot_password','\App\Http\Controllers\API\UserController@change_password');
Route::post('users/regis','\App\Http\Controllers\API\UserController@register');
//comment
Route::get('comments','\App\Http\Controllers\API\CommentController@index');
Route::post('add_comment','\App\Http\Controllers\API\CommentController@store');
Route::post('edit_comment','\App\Http\Controllers\API\CommentController@update');
Route::post('delete_comment','\App\Http\Controllers\API\CommentController@delete');
Route::post('report_comment','\App\Http\Controllers\API\CommentController@report');
//option
Route::get('options','\App\Http\Controllers\API\OptionController@option');
