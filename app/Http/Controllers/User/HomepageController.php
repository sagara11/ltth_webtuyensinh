<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Users;

class HomepageController extends Controller
{
    function home(){
        $news = Post::paginate(20);
        $trend_first = Post::where('trend', 1)->first();
        $trend = Post::where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(3);
        $sidetrend = Post::where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);
        return view('user.page.home', compact('news','trend_first','trend','sidetrend','tuyensinh','tuyensinh_first','giaoduc','giaoduc_first'));
    }

    function chitiettin(){
        $news = Post::paginate(20);
        $trend_first = Post::where('trend', 1)->first();
        $trend = Post::where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(3);
        $sidetrend = Post::where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);
        return view('user.page.chitiettin',  compact('news','trend_first','trend','sidetrend','tuyensinh','tuyensinh_first','giaoduc','giaoduc_first'));
    }

    function video(){
        return view('user.page.video');
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
 