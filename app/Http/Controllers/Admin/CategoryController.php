<?php
namespace App\Http\Controllers\Admin;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use Session;

 
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
            
        $categories = Category::select('id','name','updated_at','parent_id','publish');
        
        $categories->where('parent_id', NULL);
        
        $categories->with(array( 'child_category' => function($q) {
                return $q->select('id','name','updated_at','parent_id','publish');
            }
        ));
        $categories = $categories->paginate(3);
        return view('admin/category/list', ['categories' => $categories, 'category'=> $category,'publish'=>'All','key'=>$key,'id'=>'All']);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create_parent()
    {
        return view('admin/category/create_parent');
    }
    public function create_child()
    {
        $data = Category::where('parent_id',NULL)->get();
        return view('admin/category/create_child',['category'=>$data]);
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
                $categories = new Category();
                $categories->name = $request->name ;
                $categories->slug = $request->slug ;
                $categories->publish = $request->publish ? 1 : 0 ;
                $categories->updated_at = now();
                if(isset($request->category_parent))
                {
                    $categories->parent_id = $request->category_parent;
                }
                $categories->save();
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
    		$request->session()->flash('fail', 'Hãy điền đầy đủ thông tin!');
       		return redirect()->route('indexCategory');
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
    public function edit_parent(Request $request)
    {
        $id = $request->id ;
        $category = Category::find($id);
    	return view('admin/category/edit_parent',['id'=>$id,'category'=>$category]);
    }
    public function edit_child(Request $request)
    {
        $id = $request->id ;
        $category = Category::find($id);
        $data = Category::where('parent_id',NULL)->get();
        return view('admin/category/edit_child',['id'=>$id,'category'=>$category,'categories'=>$data]);
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
        $users->seo_title = $request->seo_title;
        $users->seo_description = $request->description;
        $users->seo_keyword = $request->seo_keyword;    
    	$users->publish =  $request->publish ? 1 : 0; 
    	$users->updated_at = now();
        if(isset($request->category_parent))
        {
            $users->parent_id = $request->category_parent;
        }
    	$users->save();
    	$request->session()->flash('success', 'Bài viết được update thành công!');
   		return redirect()->route('indexCategory');
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
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
    }
    public function destroy(Request $request)
    {
    	$id = $request->checkbox   ;
    	if(is_array($id))
    	{
    		foreach ($id as $row) 
    	 	{
	            $categories = Category::findOrFail($row);
	        	$categories->delete();
        	}
    	}
    	else
    	{
    		 $categories = Category::findOrFail($id);
    		 $categories->delete();
    	}
        $request->session()->flash('delete', 'Bài viết được xóa thành công!');
    	return redirect()->route('indexCategory');
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
	public function filter(Request $request)
	{
        $key=true;
        $category = Category::all();
        $requests = array('name'=> $request->name ? $request->name : 'All','publish' => $request->publish);
        foreach ($requests as $key => $value) 
        {
            if($value != 'All')
            {
                 $DB[] = array($key, '=', $value); 
            }
        }
        if(isset($DB))
        {
            $categories = Category::where($DB)->paginate(8);
            if($categories[0]==null)
            {
            	$category = Category::all();
        		return view('admin/category/list', ['category' => $category, 'categories'=> $categories,'publish'=>
                    $request->publish,'key'=>$key,'id'=>'All']);
            }
            else
            {
        		return view('admin/category/list',['category' => $category,'categories'=> $categories,'publish'=>
                    $request->publish,'key'=>$key,'id'=>'All']);
            }
        }  
    	else
        {
            return redirect()->route('indexCategory');
        }
        return view('admin/category/list',['category' => $category,'categories'=> $categories,'id'=>$categories[0]->name,'publish'=>$request->publish,'key'=>$key]);
	}
}



