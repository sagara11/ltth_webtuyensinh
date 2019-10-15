<?php

namespace App\Http\Controllers\Admin;
use App\Banner;
use App\User;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Banner $banners)
    {
        $key=false;
        return view('admin.banner.list', ['banners' => $banners->paginate(8),'position'=>'All','publish'=>'All','key'=>$key]);
    }
 	public function test(Banner $users)
    {
        return view('banner/test');
    }
    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/banner/create');
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
    	if($request->name != '' && $request->link != '' && $request->image != '' && $request->position != '' && $request->publish != '')
    	{
	        $users = new Banner();
	    	$users->name = $request->name ;
	    	$users->link = $request->link ;
	    	$users->image= $request->image ;
	    	$users->description = $request->description ;
	    	$users->position = $request->position ;
	    	$users->publish = $request->publish ? 1 : 0 ;
	    	$users->updated_at = now();
	    	$users->save();
	    	$request->session()->flash('success', 'Bài viết được tạo thành công!');
       		return redirect()->route('indexBanner')->with('Bài viết đã được tạo ra thành công!');
       	}
       	else
       	{
       		$request->session()->flash('status', 'Hãy điền đầy đủ thông tin!');
       		return redirect()->route('createBanner');
       	}
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
        $banners = Banner::find($id);
    	return view('admin/banner/edit',['id'=>$id,'banners'=>$banners]);
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
        $users = Banner::find($request->getid);
    	if($request->name != '' && $request->link != '' && $request->image != '' && $request->position != '')
    	{
	    	$users->name  = $request->name ;
	    	$users->link  = $request->link ;
	    	$users->image = $request->image ;
	    	$users->position =  $request->position ;
	    	$users->description = $request->description ;
	    	$users->publish =  $request->publish ? 1 : 0 ;
	    	$users->updated_at = now();
	    	$users->save();
	    	$request->session()->flash('success', 'Bài viết được update thành công!');
       		return redirect()->route('indexBanner');
    	}
    	else
    	{
            $id=$request->getid;
    		$request->session()->flash('fail', 'Hãy điền đầy đủ thông tin!');
       		return view('admin/banner/edit',['id'=>$id,'user'=>$users]);
    	}
    }
    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
	public function filter(Request $request)
	{
        $key=true;
        $requests = array('name'=> $request->name ? $request->name : 'All','position'=>$request->position ? $request->position : 'All','publish' => $request->publish);
    	foreach ($requests as $key => $value) 
    	{
    		if($value != 'All')
			{
	    	     $DB[] = array($key, '=', $value); 
	    	}
		}
        if(isset($DB))
        {
            $banners = Banner::where($DB)->paginate(8);
            if($banners[0]==null)
            {
                return view('admin.banner.list',['banners'=>$banners,'position'=>$request->position,'publish'=>$request->publish,'search'=>$request->name,'key'=>$key]);
            }
            else
            {
               return view('admin.banner.list',['banners'=>$banners,'position'=>$request->position,'publish'=>$request->publish,'key'=>$key]);
            }
        }  
    	else
        {
            return redirect()->route('indexBanner');
        }
        return view('admin.banner.list',['banners'=>$banners,'position'=>'All','publish'=>$request->publish,'key'=>$key]);
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
    }
    public function destroy(Request $request)
    {
        $id = $request->checkbox;
        if(is_array($id))
        {
            foreach ($id as $row) 
            {
                $banners = Banner::findOrFail($row);
                $banners->delete();
            }
        }
        else
        {
             $banners = Banner::findOrFail($id);
             $banners->delete();
        }
        $request->session()->flash('delete', 'Bài viết được xóa thành công!');
        return redirect()->route('indexBanner');
    }
	public function activate(Request $request)
	{
        if($request->checkbox == null)
        {
            $request->session()->flash('fail', 'Xin mời bạn hãy chọn bất kì 1 ô nào đó !!! ');
            return redirect()->route('indexBanner');
        }
        $id=$request->checkbox;
			if (is_array($id)) 
            {
            foreach ($id as $item) 
            {
                $list = Banner::findOrfail($item);
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
            $list = Banner::findOrfail($id);
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
        return redirect()->route('indexBanner'); 
    }
}
