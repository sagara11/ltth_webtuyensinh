<?php

namespace App\Http\Controllers\User;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
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
    function home()
    {
        $trend_first = Post::where('trend', 1)->where('publish',1)->where('type_post','post')->first();
        $trend = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('publish',1)->where('type_post','post')->offset(2)->paginate(3);
        if(empty($trend_first)){
            $trend_first = Post::orderBy('id', 'desc')->where('publish',1)->where('type_post','post')->first();
            $trend = Post::orderBy('id', 'desc')->where('publish',1)->where('type_post','post')->where('id', "!=", $trend_first->id)->paginate(3);
        }
        $news = Post::orderBy('id', 'desc')->where('publish',1)->where('type_post','post')->paginate(20);
        return view('user.page.home', compact('news', 'trend_first', 'trend'));
    }

    function danhmuc($slug)
    {
        $header_id = Category::where('slug', $slug)->first();
        if(isset($header_id)==false){
            return view('user.layout.error404');
        }
        $trend_first = Post::where('trend', 1)->where('category_id', $header_id->id)->where('type_post','post')->first();
        $trend = Post::orderBy('created_at', 'desc')->where('trend', 1)->offset(2)->where('category_id', $header_id->id)->where('type_post','post')->paginate(3);
        if(empty($trend_first)){
            $trend_first = Post::where('category_id', $header_id->id)->where('type_post','post')->first();
            $trend = Post::where('category_id', $header_id->id)->where('type_post','post')->where('id', "!=", $trend_first->id)->paginate(3);
        }
        $news = Post::orderBy('id', 'desc')->where('category_id', $header_id->id)->where('id', "!=", $trend_first->id)->where('publish',1)->where('type_post','post')->paginate(20);
        $now = Carbon::now();
        return view('user.page.home', compact('news', 'trend_first', 'trend', 'header_id'));
    }

    function chitiettin($slug)
    {
        $new = Post::orderBy('created_at', 'desc')->where('slug', $slug)->where('publish',1)->first();
        if(isset($new)==false){
            return view('user.layout.error404');
        }
        $xuhuong = Post::orderBy('created_at', 'desc')->where('trend', 1)->where('id','!=',$new->id)->where('type_post','post')->paginate(4);
        $tinlienquan = Post::orderBy('created_at', 'desc')->where('category_id', $new->category_id)->where('publish',1)->where('id','!=',$new->id)->where('type_post','post')->paginate(4);
        $tinmoi = Post::orderBy('created_at', 'desc')->where('publish',1)->where('type_post','post')->paginate(4);
        $tinnong = Post::orderBy('view', 'desc')->where('publish',1)->where('type_post','post')->paginate(4);

        $new->view =  $new->view + 1;
        $new->save();
        
        try{
            $comment = Comment::where('post_id', $new->id)->where('parent_id', NULL)->paginate(5);
        }
        catch(\Exception $e){
            $comment = "Chưa có bình luận";
        }
         
        return view('user.page.chitiettin', compact('comment', 'new', 'xuhuong', 'tinlienquan','tinmoi', 'tinnong'));
    }

    function nguontin($danhmuc_id)
    {
        $data = Post::where('source_id',$danhmuc_id);

        $data_first = $data->where('source_id',$danhmuc_id)->orderBy('view','desc')->first();

        $data_third = Post::where('source_id',$danhmuc_id)->orderBy('created_at','desc')->where('type_post','post')->paginate(20);
        $tinlienquan = Post::orderBy('created_at', 'desc')->where('category_id', $data_first->category_id)->where('publish',1)->where('id','!=',$data_first->id)->where('type_post','post')->paginate(4);
        $tinmoi = Post::orderBy('created_at', 'desc')->where('publish',1)->where('type_post','post')->paginate(4);
        $tinnong = Post::orderBy('view', 'desc')->where('publish',1)->where('type_post','post')->paginate(4);
     
        return view('user.page.nguontin', compact('data_first','data_third', 'tinlienquan', 'tinmoi', 'tinnong'));
    }

    function search(REQUEST $request)
    {
        $name = $request->name_search;
        $news_name = Post::where('name','like', '%'.$request->name_search.'%')->where('type_post','post')->get();
        return view('user.page.timkiem', compact('news_name', 'name'));

    }

    function video()
    {
        return view('user.page.video');
    }

    function taikhoan()
    {
        $header = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        return view('user.page.taikhoan', compact('user_post','header','user','comment'));
    }

    function doimatkhau(){
        $header = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        return view('user.page.doimatkhau', compact('user_post','header','user','comment'));
    }

    function thembaidang(){
        $header = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        return view('user.page.thembaidang', compact('user_post','header','user','comment'));
    }

    function danhsachbaidang(){
        $header = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        return view('user.page.danhsachbaidang', compact('user_post','header','user','comment'));
    }

    function quanlybinhluan(){
        $header = Post::orderBy('view', 'desc')->where('type_post','post')->paginate(3);
        $user = Auth::user();
        $user_post = Post::where('user_id', Auth::user()->id)->get();
        $comment = Comment::where('user_id', Auth::user()->id)->get();
        return view('user.page.quanlybinhluan', compact('user_post','header','user','comment'));
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

    function update_post_image(Request $request){
        $avatar_upload = new UserController;
        $url = $avatar_upload->Xulyupload($request, $request->post_id);
        
        $avatar = Post::where('id', $request->post_id)->first();
        $avatar->image = $url;
        $avatar->save();

        return back();
    }

    function delete_comment(Request $request){
        Comment::where('id', $request->comment_delete_id)->delete();
        return back();
    }

    function chitiettin_delete_comment($comment_id){
        Comment::where('id', $comment_id)->delete();
        return back();
    }

    function update_comment(Request $request){
        Comment::where('id',$request->get_id)->update(['comment' => $request->updatecomment]);
        return back();
    }

    function news_create(Request $request){
        $webtuyensinh = Crawl::where('categories_name',NULL)->first();
        $news = new Post;
        $news->source_id = $webtuyensinh->id;
        $news->name = $request->news_name;
        $news->slug = str_slug($request->news_name, '-');
        $news->description = $request->news_description;
        $news->content = $request->news_content;
        $news->image = "avatar";
        $news->type_post = "forum";
        $news->publish = 0;
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
        return $this->danhsachbaidang();
    }

    function update_view($post_id){
        $user = Auth::user();
        $post_update = Post::where('id', $post_id)->first();
        return view('user.page.update_post',compact('post_update','user'));
    }

    function updatepost(Request $request){
        $image = $request->image_1;
        Post::where('id', $request->update_id)->update([
            'name'=>$request->update_name,
            'image'=>$image,
            'description'=>$request->update_description,
            'content'=>$request->update_content
        ]);
        return $this->danhsachbaidang();
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

    public function Xulyupload2(Request $rq,$id)
    {
        $rules = [ 'image_1' => 'avatar|max:1024' ]; 
        $posts = [ 'image_1' => $rq->file('image_1') ];

        $valid = Validator::make($posts, $rules);
            // Ko có lỗi, kiểm tra nếu file đã dc upload
            if ($rq->file('image_1')->isValid()) {
                // Filename cực shock để khỏi bị trùng
                $fileName = $rq->file('image_1')->storeAs('userfiles/images/avatar','avatar'.$id.'.jpg');
                // Thư mục upload
                $uploadPath = public_path('userfiles/images/avatar'); // Thư mục upload
                // Bắt đầu chuyển file vào thư mục
                $rq->file('image_1')->move($uploadPath,$fileName);
                // Thành công, show thành công
                $photoURL = url($fileName);
                return $photoURL;
            }
        }
}