<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('user.layout.header',function($view){
            $nav_section = Category::where('parent_id', NULL)->get();
            $view->with('nav_section', $nav_section);
        });
        view()->composer('user.layout.footer',function($view){
            $nav_section = Category::where('parent_id', NULL)->get();
            $view->with('nav_section', $nav_section);
        });
        view()->composer('user.page.taikhoan',function($view){
            $nav_section = Category::where('parent_id', NULL)->get();
            $view->with('nav_section', $nav_section);
        });
        view()->composer('user.page.doimatkhau',function($view){
            $nav_section = Category::where('parent_id', NULL)->get();
            $view->with('nav_section', $nav_section);
        });
        view()->composer('user.page.thembaidang',function($view){
            $nav_section = Category::where('parent_id', NULL)->get();
            $view->with('nav_section', $nav_section);
        });
        view()->composer('user.page.danhsachbaidang',function($view){
            $nav_section = Category::where('parent_id', NULL)->get();
            $view->with('nav_section', $nav_section);
        });
        view()->composer('user.page.quanlybinhluan',function($view){
            $nav_section = Category::where('parent_id', NULL)->get();
            $view->with('nav_section', $nav_section);
        });

        view()->composer('user.layout.sidebar',function($view){
            $xuhuong_first = Post::orderBy('view', 'desc')->first();
            $xuhuong = Post::orderBy('view', 'desc')->paginate(5);
            $view->with('xuhuong_first', $xuhuong_first)->with('xuhuong', $xuhuong);
        });
    }
}
