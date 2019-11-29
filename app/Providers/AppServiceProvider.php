<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

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
    }
}
