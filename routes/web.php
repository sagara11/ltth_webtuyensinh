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

Route::get('/crawl/{frequency}', 'CrawlController@crawl_routine')->name('crawl');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['prefix' => 'admin'], function() {
		Route::group(['middleware' => 'auth'], function () {

		// Route::resource('banner','\App\Http\Controllers\Admin\BannerController');
		Route::get('banner/list','\App\Http\Controllers\Admin\BannerController@index')->name('indexBanner');
		Route::get('banner/create','\App\Http\Controllers\Admin\BannerController@create')->name('createBanner');
		Route::post('banner/store','\App\Http\Controllers\Admin\BannerController@store')->name('storeBanner');
		Route::post('banner/update','\App\Http\Controllers\Admin\BannerController@update')->name('updateBanner');
		Route::get('banner/filter','\App\Http\Controllers\Admin\BannerController@filter')->name('filterBanner');
		Route::post('banner/method','\App\Http\Controllers\Admin\BannerController@method')->name('methodBanner');
		Route::get('banner/edit','\App\Http\Controllers\Admin\BannerController@edit')->name('editBanner');
		Route::post('banner/destroy','\App\Http\Controllers\Admin\BannerController@destroy')->name('destroyBanner');
		// Route::resource('post','\App\Http\Controllers\Admin\BannerController');
		Route::get('post/list','\App\Http\Controllers\Admin\PostController@index')->name('indexPost');
		Route::get('post/create','\App\Http\Controllers\Admin\PostController@create')->name('createPost');
		Route::post('post/store','\App\Http\Controllers\Admin\PostController@store')->name('storePost');
		Route::get('post/filter','\App\Http\Controllers\Admin\PostController@filter')->name('filterPost');
		Route::post('post/activate','\App\Http\Controllers\Admin\PostController@activate')->name('activatePost');
		Route::get('post/edit','\App\Http\Controllers\Admin\PostController@edit')->name('editPost');
		Route::post('post/destroy','\App\Http\Controllers\Admin\PostController@destroy')->name('destroyPost');
		Route::post('post/slug','\App\Http\Controllers\Admin\PostController@slug')->name('slugPost');
		Route::post('post/update','\App\Http\Controllers\Admin\PostController@update')->name('updatePost');
		Route::post('post/method','\App\Http\Controllers\Admin\PostController@method')->name('methodPost');
		Route::get('post/search','\App\Http\Controllers\Admin\PostController@search')->name('searchPost');
		// Route::resource('category','\App\Http\Controllers\Admin\CategoryController');
		Route::get('category/list','\App\Http\Controllers\Admin\CategoryController@index')->name('indexCategory');
		Route::get('category/create_parent','\App\Http\Controllers\Admin\CategoryController@create_parent')->name('createCategory');
		Route::get('category/create_child','\App\Http\Controllers\Admin\CategoryController@create_child');
		Route::post('category/store','\App\Http\Controllers\Admin\CategoryController@store')->name('storeCategory');
		Route::get('category/filter','\App\Http\Controllers\Admin\CategoryController@filter')->name('filterCategory');
		Route::post('category/activate','\App\Http\Controllers\Admin\CategoryController@activate')->name('activateCategory');
		Route::get('category/edit_parent','\App\Http\Controllers\Admin\CategoryController@edit_parent')->name('editCategory');
		Route::get('category/edit_child','\App\Http\Controllers\Admin\CategoryController@edit_child')->name('editChildCategory');
		Route::post('category/method','\App\Http\Controllers\Admin\CategoryController@method')->name('methodCategory');
		Route::post('category/slug','\App\Http\Controllers\Admin\CategoryController@slug')->name('slugCategory');
		Route::post('category/update','\App\Http\Controllers\Admin\CategoryController@update')->name('updateCategory');
		Route::get('post/init','\App\Http\Controllers\Admin\ElasticsearchController@init');
		// Route::resource('user','\App\Http\Controllers\Admin\UserController');
		Route::get('user/list','\App\Http\Controllers\Admin\UserController@index')->name('indexUser');
		Route::get('user/create','\App\Http\Controllers\Admin\UserController@create')->name('createUser');
		Route::post('user/store','\App\Http\Controllers\Admin\UserController@store')->name('storeUser');
		Route::get('user/filter','\App\Http\Controllers\Admin\UserController@filter')->name('filterUser');
		Route::post('user/method','\App\Http\Controllers\Admin\UserController@method')->name('methodUser');
		Route::get('user/edit','\App\Http\Controllers\Admin\UserController@edit')->name('editUser');
		Route::post('user/destroy','\App\Http\Controllers\Admin\UserController@destroy')->name('destroyUser');
		Route::post('user/slug','\App\Http\Controllers\Admin\UserController@slug')->name('slugUser');
		Route::post('user/update','\App\Http\Controllers\Admin\UserController@update')->name('updateUser');
		Route::get('user/change_password','\App\Http\Controllers\Admin\UserController@change_password')->name('change_passwordUser');
		Route::post('user/check_password','\App\Http\Controllers\Admin\UserController@check_password')->name('check_passwordUser');
		Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
		// Route::resource('comment','\App\Http\Controllers\Admin\CommentController');
		Route::get('comment/list','\App\Http\Controllers\Admin\CommentController@index')->name('indexComment');
		Route::post('comment/activate','\App\Http\Controllers\Admin\CommentController@activate')->name('activateComment');
		Route::get('comment/create','\App\Http\Controllers\Admin\CommentController@create')->name('createComment');
		Route::get('user/filter','\App\Http\Controllers\Admin\UserController@filter')->name('filterUser');
		});	
	});
// Route::resource('crawl','\App\Http\Controllers\Admin\CrawlController');
Route::get('/crawl/{domain}', 'CrawlController@pages_insert')->name('crawl');


Route::group(['prefix'=>'menu'], function () {
	Route::group(['middleware' => 'auth'], function () {

	Route::get('index','MenuController@index')->name('indexMenu');

	// Route::get('create','CategoriesController@create')->name('createCategories');

	// Route::post('store','CategoriesController@store')->name('storeCategories');

	// Route::get('edit','CategoriesController@edit')->name('editCategories');

	// Route::post('update','CategoriesController@update')->name('updateCategories');

	// Route::post('destroy','CategoriesController@destroy')->name('destroyCategories');
	});
});

Route::group(['prefix'=>'elastic'], function () {
	Route::group(['middleware' => 'auth'], function () {

	Route::get('search','ElasticsearchController@search')->name('searchElasticsearchController');

	Route::get('init','ElasticsearchController@init')->name('initController');
	});
});

Route::get("/",'User\HomepageController@home');

Route::get("/chitiettin",'User\HomepageController@chitiettin');

Route::get('/video', 'User\HomepageController@video');

Route::post("/signin","User\HomepageController@signin")->name('signin');