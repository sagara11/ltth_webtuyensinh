<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Banner;  
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
            $tuyensinh_first = Post::where('category_id', 37)->first();
            $tuyensinh = Post::orderBy('created_at', 'asc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->where('publish',1)->paginate(4);
            $giaoduc_first = Post::where('category_id', 34)->where('publish',1)->first();
            $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->where('publish',1)->paginate(4);
            $xuhuong_first = Post::orderBy('view', 'desc')->where('type_post','post')->first();
            $xuhuong = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(5);
            $view->with('tuyensinh_first', $tuyensinh_first)->with('tuyensinh', $tuyensinh)->with('giaoduc_first', $giaoduc_first)->with('giaoduc', $giaoduc)->with('xuhuong_first', $xuhuong_first)->with('xuhuong', $xuhuong);
        });

        view()->composer('user.page.home',function($view){
            $header = Post::orderBy('view', 'desc')->paginate(3);
            $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);
            $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();
            $trend_first = Post::where('trend', 1)->where('publish',1)->where('type_post','post')->first();
            if(empty($trend_first)){
                $trend_first = Post::orderBy('id', 'desc')->where('publish',1)->where('type_post','post')->first();
            }
            $webtuyensinh_first = Category::where('id', $trend_first->category_id)->first();
            $view->with('webtuyensinh_first', $webtuyensinh_first)->with('footer_banner', $footer_banner)->with('banner', $banner)->with('header', $header)->with('banner', $banner);
        });

        view()->composer('user.page.nguontin',function($view){
            $header = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(3);
            $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);
            $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();
            $trend_first = Post::where('trend', 1)->where('publish',1)->where('type_post','post')->first();
            if(empty($trend_first)){
                Post::orderBy('id', 'desc')->where('publish',1)->where('type_post','post')->first();
            }
            $view->with('footer_banner', $footer_banner)->with('banner', $banner)->with('header', $header)->with('banner', $banner);
        });

        view()->composer('user.page.timkiem',function($view){
            $header = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(3);
            $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);
            $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();
            $trend_first = Post::where('trend', 1)->where('publish',1)->where('type_post','post')->first();
            if(empty($trend_first)){
                Post::orderBy('id', 'desc')->where('publish',1)->where('type_post','post')->first();
            }
            $sidetrend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->where('publish',1)->paginate(6);
            $view->with('footer_banner', $footer_banner)->with('banner', $banner)->with('header', $header)->with('banner', $banner)->with('sidetrend', $sidetrend);
        });
    }
}
