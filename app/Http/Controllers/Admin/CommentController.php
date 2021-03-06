<?php

namespace App\Http\Controllers\Admin;
use App\Comment;
use App\Category;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Redirect;

class CommentController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    { 
        if(isset($request->date))
        {
            return $this->filter($request->date);
        }
        $posts = Post::all();

        $post = $request->post_id ? $request->post_id : 'All';

        if($post == 'All')
        {
            return $this->sub_index($request);
        }
        if(isset($request->post_id) && $request->post_id != 'All')
            $name = Post::find($post);

        $comments = Comment::where('post_id', $post)->where('parent_id', NULL);
        
        $comments->with(array( 'user' => function($q) {
            return $q->select('id','name','avatar');
        }
    ));

        $comments->with(['child_comments' => ( function ($q) use ($post) {
            return $q->where('post_id', $post)->with(array( 'user' => function($q) {
                return $q->select('id','name','avatar');
            }
        ));
        }
    )]);
        $comments = $comments->orderBy('created_at','DESC')->paginate(10);
        return view('admin/comment/list',['comments'=>$comments,'post'=>$posts,'name'=> $post != 'All' ? $name->name : '--All--','post_id'=>$post,'x'=>1]);
    }
    public function index_new(Request $request)
    { 
        if(isset($request->date))
        {
            return $this->filter($request->date);
        }
        $posts = Post::all();

        $post = $request->post_id ? $request->post_id : 'All';
        if($post == 'All')
        {
            return $this->sub_index2($request);
        }
        if(isset($request->post_id) && $request->post_id != 'All')
            $name = Post::find($post_id);

        $comments = Comment::where('post_id', $post);
        
        $comments->with(array( 'user' => function($q) {
            return $q->select('id','name','avatar');
        }
    ));

        // $comments->with(['child_comments' => ( function ($q) use ($post) {
        //         return $q->where('post_id', $post)->with(array( 'user' => function($q) {
        //             return $q->select('id','name','avatar');
        //         }
        //     ));
        //     }
        // )]);
        $comments = $comments->orderBy('created_at','DESC')->paginate(10);
        return view('admin/comment/list_new',['comments'=>$comments,'post'=>$posts,'name'=> $post != 'All' ? $name->name : '--All--','post_id'=>$post,'x'=>1]);
    }
    public function sub_index(Request $request)
    {
        $posts = Post::all();
        $comments = Comment::where('parent_id', NULL);
        
        $comments->with(array( 'user' => function($q) {
            return $q->select('id','name','avatar');
        }
    ));

        $comments->with(['child_comments' => ( function ($q) {
            return $q->with(array( 'user' => function($q) {
                return $q->select('id','name','avatar');
            }
        ));
        }
    )]);
        $comments = $comments->orderBy('created_at','DESC')->paginate(10);
        return view('admin/comment/list',['comments'=>$comments,'post'=>$posts,'name'=>'--All--','post_id'=>'All','x'=>1]);
    }
    public function sub_index2(Request $request)
    {
        $posts = Post::all();
        $comments = Comment::select('id','parent_id','comment','publish','user_id','post_id','created_at');
        
        $comments->with(array( 'user' => function($q) {
            return $q->select('id','name','avatar');
        }
    ));
        $comments = $comments->orderBy('created_at','DESC')->paginate(10);
        return view('admin/comment/list_new',['comments'=>$comments,'post'=>$posts,'name'=>'--All--','post_id'=>'All','x'=>1]);
    }
    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function method(Request $request)
    {
        if($request->option == 'delete'&& $request->checkbox != null)
        {
         return $this->destroy($request);
     }
     elseif($request->option == 'activate'&& $request->checkbox != null)
     {
        return $this->activate($request); 
    }
    else
    {
        $request->session()->flash('fail', 'Hãy chọn tác vụ hoặc chọn bất kì 1 ô nào đó !!! ');
        return redirect()->route('indexComment');
    }
}
public function method_new(Request $request)
{
    if($request->option == 'delete'&& $request->checkbox != null)
    {
     return $this->destroy_new($request);
 }
 elseif($request->option == 'activate'&& $request->checkbox != null)
 {
    return $this->activate_new($request); 
}
else
{
    $request->session()->flash('fail', 'Hãy chọn tác vụ hoặc chọn bất kì 1 ô nào đó !!! ');
    return redirect()->route('indexComment');
}
}
public function destroy(Request $request)
{
    $id = $request->checkbox;
    if(is_array($id))
    {
        foreach ($id as $row) 
        {
            $comments = Comment::findOrFail($row);
            $comments->delete();
        }
    }
    else
    {
       $comments = Comment::findOrFail($id);
       $comments->delete();
   }
   $url = "/admin/comment/list";
   return Redirect::to($url);
}
public function destroy_new(Request $request)
{
    $id = $request->checkbox;
    if(is_array($id))
    {
        foreach ($id as $row) 
        {
            $comments = Comment::findOrFail($row);
            $comments->delete();
        }
    }
    else
    {
       $comments = Comment::findOrFail($id);
       $comments->delete();
   }
   $url = "/admin/comment/list_new";
   return Redirect::to($url);
}
public function activate(Request $request)
{
  if($request->checkbox == null)
  {
     $request->session()->flash('fail', 'Xin mời bạn hãy chọn bất kì 1 ô nào đó !!! ');
     return redirect()->route('indexComment');
 }
 $id=$request->checkbox;

 if (is_array($id) && !empty($id[1])) 
 {
    foreach ($id as $item) 
    {
        $list = Comment::findOrfail($item);
        if($list->publish) 
        {
            $list->publish = false;
            $list->save();
        } else {
            $list->publish = true;
            $list->save();
        }
    }
            // if($request->checkall)
            // $this->activate_parent($id[0]);
} 
else 
{
    $list = Comment::findOrfail($id[0]);

    if($list->publish) 
    {
        $list->publish = false;
        $list->save();
    } else 
    {
        $list->publish = true;
        $list->save();
    }
            // if($request->checkall)
            // $this->activate_parent($id[0]);
}
$request->session()->flash('success', 'Kích hoạt / Vô hiệu hóa thành công !!!');
$url = "/admin/comment/list";
return Redirect::to($url);
}
public function activate_new(Request $request)
{
    if($request->checkbox == null)
    {
        $request->session()->flash('fail', 'Xin mời bạn hãy chọn bất kì 1 ô nào đó !!! ');
        return redirect()->route('indexComment');
    }
    $id=$request->checkbox;

    if (is_array($id) && !empty($id[1])) 
    {
        foreach ($id as $item) 
        {
            $list = Comment::findOrfail($item);
            if($list->publish) 
            {
                $list->publish = false;
                $list->save();
            } else {
                $list->publish = true;
                $list->save();
            }
        }
            // if($request->checkall)
            // $this->activate_parent($id[0]);
    } 
    else 
    {
        $list = Comment::findOrfail($id[0]);

        if($list->publish) 
        {
            $list->publish = false;
            $list->save();
        } else 
        {
            $list->publish = true;
            $list->save();
        }
            // if($request->checkall)
            // $this->activate_parent($id[0]);
    }
    $request->session()->flash('success', 'Kích hoạt / Vô hiệu hóa thành công !!!');
    $url = "/admin/comment/list_new";
    return Redirect::to($url);
}
public function activate_parent($id)
{
    $data = Comment::where('id',$id)->first();
    $comment = Comment::where('parent_id',NULL)->where('id',$data->parent_id)->first();
    if($comment->publish) 
    {
        $comment->publish = false;
        $comment->save();
    } else {
        $comment->publish = true;
        $comment->save();
    }
}
}



