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
        return view('admin.banner.list', ['banners' => $banners->paginate(8), 'id' => 'All','key'=>$key]);
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
    	if($request->name != '' && $request->link != '' && $request->image != '' && $request->position != '' && $request->publish != '')
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
       		return view('banner/edit',['id'=>$id,'user'=>$users]);
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
	            $users = Banner::findOrFail($row);
	        	$users->delete();
        	}
    	}
    	else
    	{
    		 $users = Banner::findOrFail($id);
    		 $users->delete();
    	}
        $request->session()->flash('delete', 'Bài viết được xóa thành công!');
    	return redirect()->route('indexBanner');
	}
	public function filter(Request $request)
	{
            $key=true;
			$timeValue = explode('-', $request->date);
            $start = date('Y-m-d', strtotime($timeValue[0]));
            $end = date('Y-m-d', strtotime($timeValue[1]));
            $requests = array('name'=>$request->name,'position'=>$request->position,'updated_at' => $start);
    	foreach ($requests as $key => $value) 
    	{
    		if($value != 'All')
    			{
		    		if($key == 'updated_at' && $start != $end)
		    		{
		    			$DB[] = array($key,'>=',$value);
		    			$DB[] = array($key,'<=',$end);   
		    		}
		    		elseif($key != 'updated_at' && $value != null)
					{
					    $DB[] = array($key, '=', $value); 
					}
		    	}
		}
        if(isset($DB))
        {
            $user = Banner::where($DB)->paginate(8);
            if($user[0]==null)
            {
                return view('admin.banner.list',['banners'=>$user,'id'=>'All','search'=>$request->name,'key'=>$key]);
            }
            else
            {
                if($request->position=='All')
                {
                    return view('admin.banner.list',['banners'=>$user,'id'=>'All','key'=>$key]);
                }
            }
        }  
    	else
        {
            return redirect()->route('indexBanner');
        }
        return view('admin.banner.list',['banners'=>$user,'id'=>$request['position'],'key'=>$key]);
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
