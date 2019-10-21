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

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */

	public function filter($date)
	{
        $key=true;
		$category = Comment::all();
        $start = '' ;
        $end = '' ;
        if(isset($date))
        {
            $timeValue = explode('-', $date);
            $start = date('Y-m-d', strtotime($timeValue[0]));
            $end = date('Y-m-d', strtotime($timeValue[1]));
        }
        $requests = array('updated_at' => $start);
    	foreach ($requests as $key => $value) 
    	{
    		if($value != 'All')
    			{
		    		if($key == 'updated_at' && $start != $end)
		    		{
		    			$DB[] = array($key,'>=',$value);
		    			$DB[]=array($key,'<=',$end);   
		    		}
		    		elseif($key != 'updated_at' && $value != null)
					{
					    $DB[] = array($key, '=', $value); 
					}
		    	}
    	}
        if(isset($DB))
        {
            $categories = Category::where($DB)->paginate(8); 
            if($categories[0]==null)
            {
            	$category = Category::all();
        		return view('admin/category/list', ['category' => $category, 'categories'=> $categories,'id'=>'All','key'=>$key]);
            }
            else
            {
            	if($request->name=='All')
            	{
            		return view('admin/category/list',['category' => $category,'categories'=> $categories,'id'=>'All','key'=>$key]);
            	}
            }
        }  
    	else
        {
            return redirect()->route('indexCategory');
        }
        return view('admin/category/list',['category' => $category,'categories'=> $categories,'id'=>$categories[0]->name,'key'=>$key]);
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
        $url = "https://demo.baotuyensinh.edu.vn/admin/comment/list?post_id=".$request->id."";
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



