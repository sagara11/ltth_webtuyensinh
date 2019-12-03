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
use Illuminate\Support\Facades\Session;
use App\Post;
use App\User;
use App\Crawl;
use App\Users;
use App\Banner;
use App\Comment;
use Exception;
use Illuminate\Support\Carbon;
use Mail;
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
        return view('user.page.home', compact('header', 'banner', 'footer_banner', 'news', 'trend_first', 'trend', 'sidetrend', 'tuyensinh', 'tuyensinh_first', 'giaoduc', 'giaoduc_first', 'webtuyensinh_first', 'header_id'));
    }

    function chitiettin($slug)
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);

        $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);
        $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();

        $new = Post::orderBy('created_at', 'desc')->where('slug', $slug)->where('publish',1)->first();
        $xuhuong = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id','!=',$new->id)->paginate(4);
        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at', 'desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->where('publish',1)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);
        $tinlienquan = Post::orderBy('created_at', 'desc')->where('category_id', $new->category_id)->where('publish',1)->where('id','!=',$new->id)->paginate(4);
        $tinmoi = Post::orderBy('created_at', 'desc')->where('publish',1)->paginate(4);
        $tinnong = Post::orderBy('view', 'desc')->where('publish',1)->paginate(4);

        $new->view =  $new->view + 1;
        $new->save();


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

    function nguontin($danhmuc_id)
    {
        $header = Post::orderBy('view', 'desc')->paginate(3);

        $banner = Banner::orderBy('created_at', 'desc')->where('position', 'top')->paginate(2);
        $footer_banner = Banner::orderBy('created_at', 'desc')->where('position', 'sidebar')->first();

        $data = Post::where('source_id',$danhmuc_id);

        $data_first = $data->where('source_id',$danhmuc_id)->orderBy('view','desc')->first();

        $data_second = Post::where('source_id',$danhmuc_id)->where('id','!=',$data_first->id)->orderBy('view','desc')->paginate(3);

        $data_third = Post::where('source_id',$danhmuc_id)->orderBy('created_at','desc')->paginate(20);

        $tuyensinh_first = Post::where('category_id', 37)->first();
        $tuyensinh = Post::orderBy('created_at', 'desc')->where('category_id', 37)->where('id', "!=", $tuyensinh_first->id)->where('publish',1)->paginate(4);
        $giaoduc_first = Post::where('category_id', 34)->first();
        $giaoduc = Post::orderBy('created_at', 'desc')->where('category_id', 34)->where('id', "!=", $giaoduc_first->id)->paginate(4);
        $tinlienquan = Post::orderBy('created_at', 'desc')->where('category_id', $data_first->category_id)->where('publish',1)->where('id','!=',$data_first->id)->paginate(4);
        $tinmoi = Post::orderBy('created_at', 'desc')->where('publish',1)->paginate(4);
        $tinnong = Post::orderBy('view', 'desc')->where('publish',1)->paginate(4);
     
        return view('user.page.nguontin', compact('header', 'data_first','data_second','data_third','tuyensinh_first', 'tuyensinh', 'giaoduc_first', 'giaoduc', 'tinlienquan', 'tinmoi', 'tinnong', 'banner', 'footer_banner'));
    }

    function search(REQUEST $request)
    {
        $name = $request->name_search;
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
        return view('user.page.timkiem', compact('header', 'banner', 'footer_banner', 'news', 'trend_first', 'trend', 'sidetrend', 'tuyensinh', 'tuyensinh_first', 'giaoduc', 'giaoduc_first', 'webtuyensinh_first', 'news_name', 'name'));

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
        $active = 'All';
        return view('user.page.taikhoan', compact('active','user_post','header','user','comment'));
    }

    function doimatkhau(){
        $header = Post::orderBy('view', 'desc')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        $active = 'All';
        return view('user.page.doimatkhau', compact('active','user_post','header','user','comment'));
    }

    function thembaidang(){
        $header = Post::orderBy('view', 'desc')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        $active = 'All';
        return view('user.page.thembaidang', compact('active','user_post','header','user','comment'));
    }

    function danhsachbaidang(){
        $header = Post::orderBy('view', 'desc')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        $active = 'All';
        return view('user.page.danhsachbaidang', compact('active','user_post','header','user','comment'));
    }

    function quanlybinhluan(){
        $header = Post::orderBy('view', 'desc')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        $active = 'All';
        return view('user.page.quanlybinhluan', compact('active','user_post','header','user','comment'));
    }

    function signin(Request $request)
    {
        $account = array('email'=>$request->s_email, 'password'=>$request->s_password);
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

    function register(Request $request)
    {
        $users = Users::where('email',$request->email)->first();
        if(empty($users))
        {
            if($request->password == $request->confirm_password)
            {
                $user = new Users;
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = Hash::make($request->password);
                $user->publish = 1;
                $user->save();
                $data = "Đăng ký tài khoản thành công";
                return $data;
            }
            else
            {
                $data = "Mật khẩu nhập không đúng !!!";
                return $data;
            }
        }
        else
        {
            $data = "Email này đã tồn tại";
            return $data;
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

    function delete_comment(Request $request){
        Comment::where('id', $request->comment_delete_id)->delete();
        return redirect()->back()->with('active', 'quanlybinhluan');
    }

    function update_comment(Request $request){
        Comment::where('id',$request->get_id)->update(['comment' => $request->updatecomment]);
        return back();
    }

    function news_create(Request $request){
        $webtuyensinh = Crawl::where('categories_name', NULL)->first();
        $forum = Category::where('name', 'Forum')->first();
        $news = new Post;
        $news->name = $request->news_name;
        $news->slug = str_slug($request->news_name, '-');
        $news->description = $request->news_description;
        $news->content = $request->news_content;
        $news->category_id =$forum->id;
        $news->image = "avatar";
        $news->type_post = "forum";
        $news->publish = 0;
        $news->source_id = $webtuyensinh->id;
        $news->user_id = Auth::user()->id;
        $news->save();

        $temp = Post::where('image','avatar')->first();
        $data = new UserController;
        $temp->image = $data->Xulyupload($request,$temp->id);
        $temp->save();

        return $this->danhsachbaidang();
    }

    function deletepost(Request $request){
        $del_post = Post::where('id', $request->post_id)->first();
        $del_post->delete();
        return back();
    }

    function updatepost(Request $request){
        $data = new UserController;
        $image = $data->Xulyupload($request,$request->update_id);
        Post::where('id', $request->update_id)->update([
            'name'=>$request->update_name,
            'image'=>$image,
            'description'=>$request->update_description,
            'content'=>$request->update_content
        ]);
        return back();
    }

    function verify_password(Request $request){
        $your_user = Users::where('email', $request->your_email)->first();
        if(empty($your_user)){
            Session::flash('error', "Không tồn tại email này");
            return redirect('/xacnhanmatkhau');
        }
        else{
            if($request->new_password == $request->confirm_new_pasword){
                $your_user->password = Hash::make($request->new_password);
                $your_user->save();
                return redirect('/');
            }
            else{
                Session::flash('error', "Mật khẩu xác nhận không khớp");
                return redirect('/xacnhanmatkhau');
            }
        }
    }
 
    function xacnhanmatkhau(Request $request){
        return view('user.page.verify');
    }

    public function forgot_password(Request $request)
    {
        $data = Users::where('email',$request->forgotemail)->first();
        if(empty($data))
        {
            $inf = "Không tồn tại email này !";
            return $inf;
        }
        else
        {
            $email = $data->email;
            Mail::send('admin/mailfb', array('name'=>$data->name,'content'=>'Please click the link below to retrieve your password !!!', 'link'=>'Link:'.env('Email').'', 'your_email'=>$email), function($message) use($email) {
                $message->to($email, 'Verified Password!!!')->subject('Please click the link below to retrieve your password !!!');
            });
        }
    }

    function loadmore(Request $request)
    {
        $posts = Post::select()->limit(10)->where('publish', 1)->where('type_post', '=', 'post')->orderBy('id','desc');
        if($request->name) {
            $posts->where('name', 'like','%' .$request->name. '%');
        }
        if($request->last_id) {
            $posts->where('id', '<', $request->last_id );
        }
        $posts = $posts->get();
        $html ='';
        if($posts) {
            foreach ($posts as $key => $item) {
            $html .= '<div class="baiviet-box" id="'.$item->id.'">';
            $html .= '<div class="row">';
            $html .= '<div class="col-md-3 col-5">';
            $html .= '<a href="'.route("chitiettin",$item->slug).'" class="tintuc-img">';
            $html .= '<img class="img-fluid" src="'.$item->image.'" alt="" />';
            $html .= '</a>';
            $html .= '</div>';
            $html .= '<div class="col-md-9 col-7">';
            $html .= '<h5> <a href="'.route("chitiettin",$item->slug).'">'.$item->name.' </a> </h5>';
            $html .= '<p>';
            $html .= '<span >'.$item->categories->name.'</span>';
            $html .= '<span >'.$item->hour().'</span>';
            $html .= '<a class="webtuyensinh-link" href="">'.$item->source->web_name.'</a>';
            $html .= '</p>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            }
        }
        exit(json_encode(['html' => $html]));
    }
}