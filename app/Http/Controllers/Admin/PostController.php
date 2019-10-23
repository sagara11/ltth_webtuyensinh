<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Session;
use DB;
use App\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\ElasticsearchController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $key = false;
    	$category = Category::all();
    	return view('admin/post/list',['post'=> $post->paginate(8) , 'categories'=> $category,'id' => 'All','key'=>$key,'publish'=>'All','danhmuc'=>"All"]);
    }
    public function create(Post $users)
    {
    	$category = category::all();
    	return view('admin/post/create', ['categories' => $category]);
    }
    public function store(Request $request)
    {
    	if($request->name != '' && $request->image != '' && $request->description != '' && $request->content != '' && $request->publish != '')
    	{
            //$temp = new ElasticsearchController();
	    	$user = new Post();
	    	$user->name = $request->name ;
	    	$user->category_id = $request->information ;
	    	$user->slug = $request->slug ;
	    	$user->image= $request->image ;
	    	$user->description = $request->description ;
	    	$user->content = $request->content ;
	    	$user->seo_keyword = $request->seo_keyword ;
	    	$user->seo_title = $request->seo_title ;
	    	$user->seo_description = $request->seo_description ;
            $user->updated_at = now();
            $user->publish = $request->publish ? 1 : 0;
            $user->trend = $request->trend ? 1 : 0;
            $user->save();
            $book = (string)$user->id;
            //$temp->create($book,$request->image,$request->name,$request->description,$request->publish,$user->updated_at,$request->trend);
	    	$request->session()->flash('success', 'Bài viết được tạo thành công!');
       		return redirect()->route('indexPost');
        }
        else
        {
        	$request->session()->flash('fail', 'Hãy điền đầy đủ thông tin!');
       		return redirect()->route('createPost');
        }
    }
    public function slug(Request $request) {
	    $string=Str::slug($request->str, '-');
	    return $string;
	}
    public function edit(Request $request)
    {
	    	$id = $request->id ;
	    	$category = category::all();
        	$post = Post::find($id);
        	// $user = Post::find($id)->categories->name;
	    	return view('admin/post/edit',['id'=>$id, 'categories'=> $category ,'post'=>$post]);
	}
    public function update(Request $request)
    {
    	$posts = Post::find($request->getid);
    	$category = category::all();
    	if($request->name != '' && $request->image != '' && $request->description != '' && $request->content != '' && $request->publish != '')
    	{
            //$temp = new ElasticsearchController();
	    	$posts->name = $request->name ;
            $posts->category_id = $request->information ;
	    	$posts->slug = $request->slug ;
	    	$posts->image= $request->image ;
	    	$posts->description = $request->description ;
	    	$posts->content = $request->content ;
	    	$posts->seo_keyword = $request->seo_keyword ;
	    	$posts->seo_title = $request->seo_title ;
	    	$posts->seo_description = $request->seo_description ;
	    	$posts->updated_at = now();
	    	$posts->publish = $request->publish ? 1 : 0;
            $posts->trend = $request->trend ? 1 : 0;
            $book = (int)$request->getid;
            //$temp->upload($book,$request->getid,$request->image,$request->name,$request->description,$request->publish,$posts->updated_at,$request->trend);
	    	$posts->save();
	    	$request->session()->flash('success', 'Update thành công!');
       		return redirect()->route('indexPost');
        }
        else
        {
        	$id=$request->getid;
        	$request->session()->flash('fail', 'Hãy điền đầy đủ thông tin!');
       		return view('admin/post/edit',['categories'=> $category,'id'=>$id]);
        }
    }
    public function destroy(Request $request)
    {   
            if($request->checkbox == null)
            {
                $request->session()->flash('fail', 'Xin mời bạn hãy chọn bất kì 1 ô nào đó !!! ');
                return redirect()->route('indexPost');
            }	
        	$id = $request->checkbox;
            //$temp = new ElasticsearchController();
        	if(is_array($id))
        	{
        		foreach ($id as $row) 
        	 	{
    	            $users = Post::findOrFail($row);
    	        	$users->delete();
                    //$temp->delete($row);
            	}
        	}
        	else
        	{
        		 $users = Post::findOrFail($id);
        		 $users->delete();
                 //$temp->delete($row);
        	}
        	$request->session()->flash('delete', 'Xóa bài thành công!');
        	return redirect()->route('indexPost');

    }

	public function filter(Request $request)
	{
            $key = true;
            $category = category::all();
			// $timeValue = explode('-', $request->date);
            // $start = date('Y-m-d', strtotime($timeValue[0]));
            // $end = date('Y-m-d', strtotime($timeValue[1]));
            $requests = array('category_id' => $request->categories,'publish' => $request->publish);   
        	foreach ($requests as $key => $value) 
        	{
        		if($value != 'All')
    			{
		    		 $DB[] = array($key, '=', $value); 
		    	}
        	}
        if(isset($DB))
        {
            $post = Post::where($DB);

            $post->with(array( 'categories' => function($q) {
                return $q->select('id','name','updated_at','publish');
                }
            ));

            $post = $post->paginate(8);

            $data = Category::where('id',$request->categories)->first();

            if($post[0]==null)
            {
		    	return view('admin/post/list',['post'=>$post , 'categories'=> $category,'danhmuc'=>$data ? $data->name : "All",'key'=>$key,'publish'=>$request->publish,'danhmuc_id'=>$request->categories]);
            }
            else
            {
            	return view('admin/post/list',['post'=>$post,'categories'=> $category,'danhmuc'=>$data ? $data->name : "All",'key'=>$key,'publish'=>$request->publish,'danhmuc_id'=>$request->categories]);
            }
        }  
    	else
        {
            return redirect()->route('indexPost');
        }
        return view('admin/post/list',['post'=>$post,'categories'=> $category,'danhmuc'=>'All','key'=>$key,'publish'=>$request->publish,'danhmuc_id'=>$request->categories]);
	}

	public function activate(Request $request)
	{
        if(isset($request->option))
        {
    		if($request->checkbox == null)
    		{
    			$request->session()->flash('fail', 'Xin mời bạn hãy chọn bất kì 1 ô nào đó !!! ');
           		return redirect()->route('indexPost');
    		}
            $id=$request->checkbox;
            //$temp = new ElasticsearchController();
    			if (is_array($id)) 
                {
                foreach ($id as $item) 
                {
                    $list = Post::findOrfail($item);
                    if($list->publish) 
                    {
                        $list->publish = false;
                        $list->save();
                        //$temp->activate($item,'0');
                    } else {
                        $list->publish = true;
                        $list->save();
                        //$temp->activate($item,'1');
                    }
                }
            } 
            else 
            {
                $list = Post::findOrfail($id);
                if($list->publish) 
                {
                    $list->publish = false;
                    $list->save();
                    //$temp->activate($item,'0');
                } else 
                {
                    $list->publish = true;
                    $list->save();
                    //$temp->activate($item,'1');
                }
            }
            $request->session()->flash('success', 'Kích hoạt / Vô hiệu hóa thành công !!!');
            return redirect()->route('indexPost'); 
        }
    }
    public function trend(Request $request)
    {
        if(isset($request->option))
        {
            if($request->checkbox == null)
            {
                $request->session()->flash('fail', 'Xin mời bạn hãy chọn bất kì 1 ô nào đó !!! ');
                return redirect()->route('indexPost');
            }
            $id=$request->checkbox;
            // $temp = new ElasticsearchController();
                if (is_array($id)) 
                {
                foreach ($id as $item) 
                {
                    $list = Post::findOrfail($item);
                    if($list->trend) 
                    {
                        $list->trend = false;
                        $list->save();
                        // $temp->activate($item,'0');
                    } else {
                        $list->trend = true;
                        $list->save();
                        // $temp->activate($item,'1');
                    }
                }
            } 
            else 
            {
                $list = Post::findOrfail($id);
                if($list->publish) 
                {
                    $list->trend = false;
                    $list->save();
                    // $temp->activate($item,'0');
                } else 
                {
                    $list->trend = true;
                    $list->save();
                    // $temp->activate($item,'1');
                }
            }
            $request->session()->flash('success', 'Thay đổi thành công !!!');
            return redirect()->route('indexPost'); 
        }
    }
    public function method(Request $request)
    {
        if($request->option == 'delete' && $request->checkbox != null)
        {
            return $this->destroy($request);
        }
        elseif($request->option == 'activate' && $request->checkbox != null)
        {
            return $this->activate($request); 
        }
        elseif($request->option == 'trend' && $request->checkbox != null)
        {
            return $this->trend($request); 
        }
        elseif(isset($request->search))
        {
           return $this->search($request); 
        }
        elseif(isset($request->categories) || isset($request->publish))
        {
            return $this->filter($request);
        }
        else
        {
            $request->session()->flash('fail', 'Hãy chọn tác vụ hoặc chọn bất kì 1 ô nào đó !!! ');
            return redirect()->route('indexPost');
        }
    }
    // public function search(Request $request)
    // {
    //     if($request->search == '')
    //     {
    //         return redirect()->route('indexPost');
    //     }
    //     $key = true;      
    //     $category = category::all();
    //     $detail=$request->search;
    //     $temp = new ElasticsearchController();
    //     $data = $temp->search($detail);
    //     return view('admin/post/view',['post'=>$data,'categories'=> $category,'id' => 'All','key'=>$key,'search'=>$detail]);
    // }
}
