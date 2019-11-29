<?php

namespace App\Http\Controllers\User;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Users;
use App\Banner;
use App\Comment;
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

        $trend_first = Post::latest()->where('trend', 1)->where('publish',1)->first();
        $trend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('publish',1)->where('id', "!=", $trend_first->id)->paginate(3);
        $news = Post::orderBy('created_at', 'desc')->where('id', "!=", $trend_first->id)->where('publish',1)->paginate(20);
        $sidetrend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->where('publish',1)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at', 'asc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->where('publish',1)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->where('publish',1)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->where('publish',1)->paginate(4);

        $webtuyensinh_first = Category::where('id', $trend_first->category_id)->first();
        return view('user.page.home', compact('header', 'banner', 'footer_banner', 'news', 'trend_first', 'trend', 'sidetrend', 'tuyensinh', 'tuyensinh_first', 'giaoduc', 'giaoduc_first', 'webtuyensinh_first'));
    }

    function danhmuc($slug)
    {
        $header_id = Category::where('slug', $slug)->first();

        $header = Post::orderBy('view', 'desc')->where('publish',1)->paginate(3);

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
        $news = Post::orderBy('created_at', 'desc')->where('category_id', $header_id->id)->where('id', "!=", $trend_first->id)->where('publish',1)->paginate(20);
        $sidetrend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->where('publish',1)->paginate(6);
        $tuyensinh_first = Post::where('category_id', 37)->where('publish',1)->first();
        $tuyensinh = Post::orderBy('created_at', 'desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->where('publish',1)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->where('publish',1)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->where('publish',1)->paginate(4);

        $now = Carbon::now();

        // $this->seo();

        $webtuyensinh_first = Category::where('id', $trend_first->category_id)->first();
        return view('user.page.home', compact('header', 'banner', 'footer_banner', 'news', 'trend_first', 'trend', 'sidetrend', 'tuyensinh', 'tuyensinh_first', 'giaoduc', 'giaoduc_first', 'webtuyensinh_first'));
    }

    function chitiettin($slug)
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);

        $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);

        $new = Post::orderBy('created_at', 'desc')->where('slug', $slug)->where('publish',1)->first();
        $xuhuong = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id','!=',$new->id)->paginate(4);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at', 'desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->where('publish',1)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);
        $tinlienquan = Post::orderBy('created_at', 'desc')->where('category_id', $new->category_id)->where('publish',1)->where('id','!=',$new->id)->paginate(4);
        $tinmoi = Post::orderBy('created_at', 'desc')->where('publish',1)->paginate(4);
        $tinnong = Post::orderBy('view', 'desc')->where('publish',1)->paginate(4);


        try{
            $trend_first = Post::latest()->where('trend', 1)->where('category_id', $new->category_id)->first();
            $trend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->where('category_id', $new->category_id)->paginate(3);
        }
        catch(\Exception $e){
            $trend_first = Post::where('category_id', $new->category_id)->first();
            $trend = Post::where('category_id', $new->category_id)->where('id','!=',$trend_first->id)->paginate(3);
        }
        try{
            $comment = Comment::where('post_id', $new->id)->where('parent_id', NULL)->paginate(5);
        }
        catch(\Exception $e){
            $comment = "Chưa có bình luận";
        }
        $sidetrend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id', "!=", $trend_first->id)->paginate(6);

        $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();
         
        return view('user.page.chitiettin', compact('comment','header', 'new', 'xuhuong', 'tuyensinh_first', 'tuyensinh', 'giaoduc_first', 'giaoduc', 'tinlienquan', 'tinmoi', 'tinnong', 'banner', 'trend', 'trend_first', 'footer_banner', 'sidetrend'));
    }

    function search(REQUEST $request)
    {
        $news_name = Post::where('name','like', '%'.$request->name_search.'%')->get();
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
        return view('user.page.timkiem', compact('header', 'banner', 'footer_banner', 'news', 'trend_first', 'trend', 'sidetrend', 'tuyensinh', 'tuyensinh_first', 'giaoduc', 'giaoduc_first', 'webtuyensinh_first', 'news_name'));

    }

    function video()
    {
        return view('user.page.video');
    }

    function taikhoan()
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        return view('user.page.taikhoan', compact('user_post','header','user','comment'));
    }

    function signin(Request $request)
    {
        $account = array('email'=>$request->email, 'password'=>$request->password);
        if(Auth::attempt($account)){
            $data = Auth::user()->name;
            return $data;
        }
        else{
            $data = "Email hoặc mật khẩu không đúng";
            return $data;
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }

    function edit_account(Request $request, $edit){
        Users::where('id', Auth::user()->id)
        ->update([$edit => $request->$edit]);
        return back();
    }

    function change_password(Request $request){
        if(Hash::check($request->old_password, Auth::user()->password) && $request->new_password == $request->new_password_confirm){
            Users::where('id', Auth::user()->id)
            ->update(['password' => Hash::make($request->new_password)]);
            Auth::logout();
            return redirect('/');
        }   
        else{
            dd("nhap sai mat khau");
        }
    }

    function register(Request $request){
        $users = Users::all();
        foreach($users as $user)
        {
            if($request->email == $user->email)
            {
                $data = "Email này đã tồn tại";
                return $data;
            }
            if($request->password == $request->confirm_password){
                $user = new Users;
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = Hash::make($request->password);
                $user->save();
                $data = "Đăng ký tài khoản thành công";
                return $data;
            }
        }
    }

    function comment(Request $request){
        if($request->has('submit2')){
            $comment = new Comment;
            $comment->comment = $request->your_comment;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->parent_id = NULL;
            $comment->publish = 1;
            $comment->save();
        }
        if($request->has('submit1')){
            $comment = new Comment;
            $string = "your_comment_reply-".$request->parent_id[$request->input1];
            $comment->comment = $request->$string;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->parent_id = $request->parent_id[$request->input1];
            $comment->publish = 1;
            $comment->save();
        }
        return back();
    }

    function update_avatar(Request $request){
        $avatar_upload = new UserController;
        $url = $avatar_upload->Xulyupload($request, Auth::user()->id);
        
        $avatar = Users::find(Auth::user()->id);
        $avatar->avatar = $url;
        $avatar->save();

        return back();
    }

    function delete_comment($comment_id){
        Comment::where('id',$comment_id)->delete();
        return back();
    }

    function update_comment(Request $request){
        Comment::where('id',$request->get_id)->update(['comment' => $request->updatecomment]);
        return back();
    }

    function news_create(Request $request){
        $news = new Post;
        $news->name = $request->news_name;
        $news->slug = str_slug($request->news_name, '-');
        $news->description = $request->news_description;
        $news->content = $request->news_content;
        $news->category_id = $request->news_section;
        $news->image = $request->image;
        $news->type_post = "post";
        $news->publish = 0;
        $news->source_id = 24;
        $news->user_id = Auth::user()->id;
        $news->save();

        return back();
    }

    function deletepost(Request $request){
        $del_post = Post::where('id', $request->post_id)->first();
        $del_post->delete();
        return back();
    }

    function updatepost(Request $request){
        Post::where('id', $request->update_id)->update([
            'name'=>$request->update_name,
            'image'=>$request->update_image,
            'description'=>$request->update_description,
            'content'=>$request->update_content
        ]);
        return back();
    }
}