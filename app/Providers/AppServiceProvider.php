<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Banner;  
use App\Post;
use App\Users;

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
            $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);
            $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();
            $tuyensinh_first = Post::where('category_id', 37)->first();
            $tuyensinh = Post::orderBy('created_at', 'asc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->where('publish',1)->paginate(4);
            $giaoduc_first = Post::where('category_id', 34)->where('publish',1)->first();
            $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->where('publish',1)->paginate(4);
            $xuhuong_first = Post::orderBy('view', 'desc')->where('type_post','post')->first();
            $xuhuong = Post::orderBy('view', 'desc')->where('type_post','post')->where('id','!=',$xuhuong_first->id)->paginate(5);
            $congdong = Post::where('type_post', 'forum')->paginate(4);
            $nguoidungmoi = Users::orderBy('created_at', 'desc')->paginate(10);
            $view->with('nguoidungmoi', $nguoidungmoi)->with('congdong', $congdong)->with('banner', $banner)->with('footer_banner', $footer_banner)->with('tuyensinh_first', $tuyensinh_first)->with('tuyensinh', $tuyensinh)->with('giaoduc_first', $giaoduc_first)->with('giaoduc', $giaoduc)->with('xuhuong_first', $xuhuong_first)->with('xuhuong', $xuhuong);
        });

        view()->composer('user.page.home',function($view){
            $trend_first = Post::where('trend', 1)->where('publish',1)->where('type_post','post')->first();
            if(empty($trend_first)){
                $trend_first = Post::orderBy('id', 'desc')->where('publish',1)->where('type_post','post')->first();
            }
            $webtuyensinh_first = Category::where('id', $trend_first->category_id)->first();
            $view->with('webtuyensinh_first', $webtuyensinh_first);
        });
    }
}
