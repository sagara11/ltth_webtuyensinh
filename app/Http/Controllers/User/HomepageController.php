<?php

namespace App\Http\Controllers\User;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Users;
use App\Banner;
use Exception;
use Illuminate\Support\Carbon;

class HomepageController extends Controller
{
    function seo(){
        $seo_name = Post::where('seo_title',$this->seo_title);
        $seo_description = Post::where('seo_description',$this->seo_description);
        $seo_keyword = Pots::where('seo_keyword',$this->seo_keyword);

        $object = array(
            'seo_name' => $seo_name,
            'seo_description' => $seo_description,
            'seo_keyword' => $seo_keyword
        );

        // return mang url tung page va hinh anh
        return $object;
    }

    function home()
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);

        $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);
        $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();

        $trend_first = Post::latest()->where('trend', 1)->first();
        $trend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(3);
        $news = Post::orderBy('created_at', 'desc')->where('id', "!=", $trend_first->id)->paginate(20);
        $sidetrend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at', 'asc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);

        $webtuyensinh_first = Category::where('id', $trend_first->category_id)->first();
        return view('user.page.home', compact('header', 'banner', 'footer_banner', 'news', 'trend_first', 'trend', 'sidetrend', 'tuyensinh', 'tuyensinh_first', 'giaoduc', 'giaoduc_first', 'webtuyensinh_first'));
    }

    function danhmuc($slug)
    {
        $header_id = Category::where('slug', $slug)->first();

        $header = Post::orderBy('view', 'desc')->paginate(3);

        $banner = Banner::where('position', 'top')->paginate(2);
        $footer_banner = Banner::where('position', 'sidebar')->first();
        try{
            $trend_first = Post::latest()->where('trend', 1)->where('category_id', $header_id->id)->first();
            $trend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->where('category_id', $header_id->id)->paginate(3);
        }
        catch(\Exception $e){
            $trend_first = Post::where('category_id', $header_id->id)->first();
            $trend = Post::where('category_id', $header_id->id)->where('id','!=',$trend_first->id)->paginate(3);
        }
        $news = Post::orderBy('created_at', 'desc')->where('category_id', $header_id->id)->where('id', "!=", $trend_first->id)->paginate(20);
        $sidetrend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at', 'desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);

        $now = Carbon::now();

        // $this->seo();

        $webtuyensinh_first = Category::where('id', $trend_first->category_id)->first();
        return view('user.page.home', compact('header', 'banner', 'footer_banner', 'news', 'trend_first', 'trend', 'sidetrend', 'tuyensinh', 'tuyensinh_first', 'giaoduc', 'giaoduc_first', 'webtuyensinh_first'));
    }

    function chitiettin($slug)
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);

        $new = Post::orderBy('created_at', 'desc')->where('slug', $slug)->first();
        $xuhuong = Post::orderBy('created_at', 'desc')->where('trend', 1)->paginate(4);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at', 'desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);
        $tinlienquan = Post::orderBy('created_at', 'desc')->where('category_id', $new->category_id)->paginate(4);
        $tinmoi = Post::orderBy('created_at', 'desc')->paginate(4);
        $tinnong = Post::orderBy('view', 'desc')->paginate(4);
        return view('user.page.chitiettin', compact('header', 'new', 'xuhuong', 'tuyensinh_first', 'tuyensinh', 'giaoduc_first', 'giaoduc', 'tinlienquan', 'tinmoi', 'tinnong'));
    }

    function search(REQUEST $request)
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);
        $news_name = Post::where('name','like', '%'.$request->name_search.'%')->get();
        return view('user.page.timkiem', compact('header','news_name'));
    }

    function video()
    {
        return view('user.page.video');
    }

    function taikhoan()
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);
        $user = Auth::user();
        return view('user.page.taikhoan', compact('header','user'));
    }

    function signin(Request $request)
    {
        $account = array('email'=>$request->email, 'password'=>$request->password);
        if(Auth::attempt($account)){
            return $this->home()->with(Auth::user()->name);
        }
        else{
            dd('khong dung tai khoan');
        }
    }

    function logout(){
        Auth::logout();
        return $this->home();
    }

    function edit_account(Request $request, $edit){
        Users::where('id', Auth::user()->id)
        ->update([$edit => $request->$edit]);
        return $this->taikhoan();
    }

    function change_password(Request $request){
        dd(Auth::user()->password);
        if($request->old_password == Auth::user()->password && $request->new_password == $request->new_password_confirm){
            Users::where('id', Auth::user()->id)
            ->update(['password' => $request->new_password]);
            return $this->taikhoan();
        }   
        else{
            dd("nhap sai mat khau");
        }
    }
}
