<?php

namespace App\Http\Controllers\User;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Users;
use App\Banner;
use Illuminate\Support\Carbon;

class HomepageController extends Controller
{
    function home(){
        $header = Post::orderBy('view','desc')->paginate(3);

        $banner = Banner::orderBy('created_at','desc')->where('position','banner')->paginate(2);
        $footer_banner = Banner::orderBy('created_at','desc')->where('position','sidebar')->first();

        $trend_first = Post::latest()->where('trend', 1)->first();
        $trend = Post::orderBy('created_at','desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(3);
        $news = Post::orderBy('created_at','desc')->where('id', "!=", $trend_first->id)->paginate(20);
        $sidetrend = Post::orderBy('created_at','desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at','asc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at','desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);

        $now = Carbon::now();

        $trend_first_time = $now->diffInHours($trend_first->created_at);

        $webtuyensinh_first = Category::where('id',$trend_first->category_id)->first();
        // $webtuyensinh = Category::where('id',$trend->category_id)->get();
        return view('user.page.home', compact('header','trend_first_time','banner','footer_banner','news','trend_first','trend','sidetrend','tuyensinh','tuyensinh_first','giaoduc','giaoduc_first','webtuyensinh_first'));
    }

    function danhmuc($type){
        $header = Post::orderBy('view','desc')->paginate(3);

        $banner = Banner::orderBy('created_at','desc')->paginate(2);
        $footer_banner = Banner::orderBy('created_at','desc')->where('position','sidebar')->first();

        $trend_first = Post::latest()->where('trend', 1)->where('category_id', $type)->first();
        $trend = Post::orderBy('created_at','desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->where('category_id', $type)->paginate(3);
        $news = Post::orderBy('created_at','desc')->where('category_id', $type)->where('id', "!=", $trend_first->id)->paginate(20);
        $sidetrend = Post::orderBy('created_at','desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at','desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at','desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);

        $now = Carbon::now();

        $webtuyensinh_first = Category::where('id',$trend_first->category_id)->first();
        return view('user.page.home', compact('header','banner','footer_banner','news','trend_first','trend','sidetrend','tuyensinh','tuyensinh_first','giaoduc','giaoduc_first','webtuyensinh_first'));
    }

    function chitiettin($id){
        $header = Post::orderBy('view','desc')->paginate(3);

        $new = Post::orderBy('created_at','desc')->where('id', $id)->first();
        $xuhuong = Post::orderBy('created_at','desc')->where('trend', 1)->get();
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at','desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id',34)->first();
        $giaoduc = Post::orderBy('created_at','desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);
        $tinlienquan = Post::orderBy('created_at','desc')->where('category_id', $new->category_id)->paginate(4);
        $tinmoi = Post::orderBy('created_at','desc')->paginate(4);
        $tinnong = Post::orderBy('view','desc')->paginate(4);
        return view('user.page.chitiettin', compact('header','new','xuhuong','tuyensinh_first', 'tuyensinh', 'giaoduc_first', 'giaoduc', 'tinlienquan', 'tinmoi', 'tinnong'));
    }

    function video(){
        return view('user.page.video');
    }

    function taikhoan(){
        return view('user.page.taikhoan');
    }

    function signin(Request $request){
        $user = Users::all();
        foreach($user as $key){
            if($request->email == $key->email && $request->password == $key->password){
                $this->home();
            }
        }
        // echo "khong co tai khoan";
    }
}
 