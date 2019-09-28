<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;

 
class CategoryController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Category $categories)
    {
        $key=false;
    	$category = category::all();
        return view('admin/category/list', ['categories' => $categories->paginate(10), 'category'=> $category,'id'=>'All','key'=>$key]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/category/create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
    	if($request->name != '' && $request->publish != '' )
    	{
            $pointer = Category::where('slug',$request->slug)->get();
            if(empty($pointer[0]))
            {
                $users = new Category();
                $users->name = $request->name ;
                $users->slug = $request->slug ;
                $users->publish = $request->publish ? 1 : 0 ;
                $users->updated_at = now();
                $users->save();
                $request->session()->flash('success', 'Bài viết được tạo thành công!');
                return redirect()->route('indexCategory');
            }
            else
            {
                $request->session()->flash('fail', 'Danh mục này đã tồn tại !!! ');
                return redirect()->route('indexCategory');
            }
        }
        else
    	{
            $id=$request->getid;
    		$request->session()->flash('fail', 'Hãy điền đầy đủ thông tin!');
       		return view('admin/category/create',['id'=>$id]);
    	}
    }
	    public function slug(Request $request) {
        $string=Str::slug($request->str, '-');
        return $string;
        }
    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $id = $request->id ;
        $category = Category::find($id);
    	return view('admin/category/edit',['id'=>$id,'category'=>$category]);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
    	if($request->name != '' && $request->publish != '' )
    	{
	    	$users = Category::find($request->getid);
            $pointer = Category::where('slug','!=',$users['slug'])->get();
            foreach($pointer as $row)
            {
                if($row->slug == $request->slug)
                {
                    $id=$request->getid;
                    $request->session()->flash('fail', 'Danh mục này đã tồn tại !!! ');
                    return view('admin/category/edit',['id'=>$id,'category'=>$users]);
                }
            }
	    	$users->name  = $request->name;  
            $users->slug = $request->slug ;
	    	$users->publish =  $request->publish ? 1 : 0; 
	    	$users->updated_at = now();
	    	$users->save();
	    	$request->session()->flash('success', 'Bài viết được update thành công!');
       		return redirect()->route('indexCategory');
    	}
    	else
    	{
            $id=$request->getid;
    		$request->session()->flash('fail', 'Hãy điền đầy đủ thông tin!');
       		return view('admin/category/edit',['id'=>$id,'category'=>$users]);
    	}
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

    	$id = $request->takeid;
    	if(is_array($id))
    	{
    		foreach ($id as $row) 
    	 	{
	            $users = Category::findOrFail($row);
	        	$users->delete();
        	}
    	}
    	else
    	{
    		 $users = Category::findOrFail($id);
    		 $users->delete();
    	}
        $request->session()->flash('delete', 'Bài viết được xóa thành công!');
    	return redirect()->route('indexCategory');
    }

	public function filter(Request $request)
	{
        $key=true;
		$category = Category::all();
        $start = '' ;
        $end = '' ;
        if(isset($request->date))
        {
            $timeValue = explode('-', $request->date);
            $start = date('Y-m-d', strtotime($timeValue[0]));
            $end = date('Y-m-d', strtotime($timeValue[1]));
        }
        $requests = array('name'=> $request->name,'updated_at' => $start);
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
       		return redirect()->route('indexCategory');
		}
        $id=$request->checkbox;
			if (is_array($id)) 
            {
            foreach ($id as $item) 
            {
                $list = Category::findOrfail($item);
                if($list->publish) 
                {
                    $list->publish = false;
                    $list->save();
                } else {
                    $list->publish = true;
                    $list->save();
                }
            }
        } 
        else 
        {
            $list = Category::findOrfail($id);
            if($list->publish) 
            {
                $list->publish = false;
                $list->save();
            } else 
            {
                $list->publish = true;
                $list->save();
            }
        }
        $request->session()->flash('success', 'Kích hoạt / Vô hiệu hóa thành công !!!');
        return redirect()->route('indexCategory'); 
    }
}



