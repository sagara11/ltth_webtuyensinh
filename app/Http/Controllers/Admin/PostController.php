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
    	return view('admin/post/list',['post'=> $post->paginate(8) , 'categories'=> $category,'id' => 'All','key'=>$key]);
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
            $temp = new ElasticsearchController();
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
            $temp->create($book,$request->image,$request->name,$request->description,$request->publish,$user->updated_at);
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
    	$users = Post::find($request->getid);
    	$category = category::all();
    	if($request->name != '' && $request->image != '' && $request->description != '' && $request->content != '' && $request->publish != '')
    	{
            $temp = new ElasticsearchController();
	    	$users->name = $request->name ;
            $users->category_id = $request->information ;
	    	$users->slug = $request->slug ;
	    	$users->image= $request->image ;
	    	$users->description = $request->description ;
	    	$users->content = $request->content ;
	    	$users->seo_keyword = $request->seo_keyword ;
	    	$users->seo_title = $request->seo_title ;
	    	$users->seo_description = $request->seo_description ;
	    	$users->updated_at = now();
	    	$users->publish = $request->publish ? 1 : 0;
            $user->trend = $request->trend ? 1 : 0;
            $book = (int)$request->getid;
            $temp->upload($book,$request->getid,$request->image,$request->name,$request->description,$request->publish,$users->updated_at);
	    	$users->save();
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
            $temp = new ElasticsearchController();
        	if(is_array($id))
        	{
        		foreach ($id as $row) 
        	 	{
    	            $users = Post::findOrFail($row);
    	        	$users->delete();
                    $temp->delete($row);
            	}
        	}
        	else
        	{
        		 $users = Post::findOrFail($id);
        		 $users->delete();
                 $temp->delete($row);
        	}
        	$request->session()->flash('delete', 'Xóa bài thành công!');
        	return redirect()->route('indexPost');

    }

	public function filter(Request $request)
	{
            $key = true;
            $category = category::all();
			$timeValue = explode('-', $request->date);
            $start = date('Y-m-d', strtotime($timeValue[0]));
            $end = date('Y-m-d', strtotime($timeValue[1]));
            $requests = array('category_id' => $request->categories,'updated_at' => $start);   
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
            $post = Post::where($DB)->paginate(8);
            if($post[0]==null)
            {
		    	$category = category::all();
		    	return view('admin/post/list',['post'=>$post , 'categories'=> $category,'id' => 'All','key'=>$key]);
            }
            else
            {
            	if($request->category=='All')
            	{
            		return view('admin/post/list',['post'=>$post,'categories'=> $category,'id'=>'All','key'=>$key]);
            	}
            }
        }  
    	else
        {
            return redirect()->route('indexPost');
        }
        return view('admin/post/list',['post'=>$post,'categories'=> $category,'id'=>$post[0]->categories->name,'key'=>$key]);
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
            $temp = new ElasticsearchController();
    			if (is_array($id)) 
                {
                foreach ($id as $item) 
                {
                    $list = Post::findOrfail($item);
                    if($list->publish) 
                    {
                        $list->publish = false;
                        $list->save();
                        $temp->activate($item,'0');
                    } else {
                        $list->publish = true;
                        $list->save();
                        $temp->activate($item,'1');
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
                    $temp->activate($item,'0');
                } else 
                {
                    $list->publish = true;
                    $list->save();
                    $temp->activate($item,'1');
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
            $temp = new ElasticsearchController();
                if (is_array($id)) 
                {
                foreach ($id as $item) 
                {
                    $list = Post::findOrfail($item);
                    if($list->trend) 
                    {
                        $list->trend = false;
                        $list->save();
                        $temp->activate($item,'0');
                    } else {
                        $list->trend = true;
                        $list->save();
                        $temp->activate($item,'1');
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
                    $temp->activate($item,'0');
                } else 
                {
                    $list->trend = true;
                    $list->save();
                    $temp->activate($item,'1');
                }
            }
            $request->session()->flash('success', 'Thay đổi thành công !!!');
            return redirect()->route('indexPost'); 
        }
    }
    public function method(Request $request)
    {
        if($request->option == 'delete')
        {
            return $this->destroy($request);
        }
        elseif($request->option == 'activate')
        {
            return $this->activate($request); 
        }
        elseif($request->option == 'trend')
        {
            return $this->trend($request); 
        }
        elseif(isset($request->search))
        {
           return $this->search($request); 
        }
        else
        {
            return $this->filter($request);
        }
    }
    public function search(Request $request)
    {
        if($request->search == '')
        {
            return redirect()->route('indexPost');
        }
        $key = true;      
        $category = category::all();
        $user=$request->search;
        $temp = new ElasticsearchController();
        $data = $temp->search($user);
        return view('admin/post/view',['post'=>$data,'categories'=> $category,'id' => 'All','key'=>$key,'search'=>$user]);
    }
}
