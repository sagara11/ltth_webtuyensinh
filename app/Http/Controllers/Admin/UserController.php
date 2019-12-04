<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $users)
    {
        $key = false ;
        return view('admin/users/list', ['users' => $users->paginate(8),'key'=>$key,'publish'=>'All','role'=>'All']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        return view('admin/users/change_password');
    }
    public function check_password(Request $request)
    {
        $key = false ;
        $data = User::find(Auth::id());
        if(Hash::check($request->currentPassword,$data->password))
        {
            if($request->newPassword == $request->confirmPassword)
            {
                $data->password = Hash::make($request->newPassword);
                $data->save();
                Auth::logout();
                return redirect('/login');
            }
            else
            {
                $request->session()->flash('fail', 'Mật khẩu nhập lại không đúng !!! ');
                return view('admin/users/change_password');
            }
        }
        else
        {
            $request->session()->flash('fail', 'Mật khẩu hiện tại không đúng !!!');
            return view('admin/users/change_password');
        }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if(Auth::check())
        {
            if($request->id != '')
            {
                $data = User::find($request->id);
                return view('admin/users/edit',['data'=>$data,'id'=>$request->id]);
            }
            else
            {
                $data = Auth::user();
                return view('admin/users/edit',['data'=>$data,'id'=>Auth::id()]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $users='';
        if($request->getid == null)
        {
            $users = User::find( Auth::user()->id);
        }
        else
        {
            $users = User::find($request->getid);
        }
        if($request->name != '' && $request->email != '')
        {
            $users->name  = $request->name ? $request->name : $users->name  ;
            $users->email  = $request->email ? $request->email : $users->email;
            $users->avatar = $request->image ? $request->image : $users->avatar;
            $users->phone  = $request->phone;
            $users->publish = $request->publish ? 1 : 0 ;
            $users->updated_at = now();
            $users->save();
            $request->session()->flash('success', 'Thông tin đã được cập nhật !!');
            return redirect()->route('indexUser');
        }
        else
        {
            $id=$request->getid;
            $request->session()->flash('fail', 'Hãy điền đầy đủ thông tin!');
            return view('users/edit',['user'=>$users]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function method(Request $request)
    {
        if($request->option == 'delete' && $request->checkbox != null)
        {
            return $this->delete($request);
        }
        elseif($request->option == 'activate' && $request->checkbox != null)
        {
            return $this->activate($request); 
        }
        elseif($request->option == 'phancap')
        {
            return $this->phancap($request);
        }
        elseif($request->publish != 'All' || $request->phancap != 'All')
        {
            return $this->filter($request);
        }
        elseif(isset($request->search))
        {
            return $this->search($request);
        }
        else
        {
            $request->session()->flash('fail', 'Hãy chọn tác vụ hoặc chọn bất kì 1 ô nào đó !!! ');
            return redirect()->route('indexUser');
        }
    }
    public function phancap(Request $request)
    {
        if(Auth::user()->role_id == 1)
        {
            if(isset($request->option))
            {
                $id=$request->checkbox;
                if (is_array($id)) 
                {
                    foreach ($id as $item) 
                    {
                        $list = User::findOrfail($item);
                        if($list->role_id) 
                        {
                            $list->role_id = false;
                            $list->save();
                        } else {
                            $list->role_id = true;
                            $list->save();
                        }
                    }
                } 
                else 
                {
                    $list = User::findOrfail($id);
                    if($list->role_id) 
                    {
                        $list->role_id = false;
                        $list->save();
                    } else 
                    {
                        $list->role_id = true;
                        $list->save();
                    }
                }
                $request->session()->flash('success', 'Phân cấp/Bỏ cấp thành công !!!');
                return redirect()->route('indexUser'); 
            }
        }
        else
        {
            $request->session()->flash('fail', 'Bạn không có quyền làm điều này !!!');
            return redirect()->route('indexUser'); 
        }
    }
    public function search(Request $request)
    {
        $key = true;
        $data = $request->search;
        $user = User::where('name', 'like','%' .$data. '%')->orWhere('email', 'like','%' .$data. '%')->orWhere('phone', 'like','%' .$data. '%');
        return view('admin/users/list',['users'=>$user->paginate(5),'key'=>$key,'publish'=>'All','search'=>$request->search,'role'=>'All']);
    }
    public function activate(Request $request)
    {
        if(isset($request->option))
        {
            $id=$request->checkbox;
            if (is_array($id)) 
            {
                foreach ($id as $item) 
                {
                    $list = User::findOrfail($item);
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
                $list = User::findOrfail($id);
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
            return redirect()->route('indexUser'); 
        }
    }
    public function delete(Request $request)
    {
        if($request->option == 'delete')
        {
            $id = $request->checkbox;
            if (is_array($id)) 
            {
                foreach ($id as $item) 
                {
                    $list = User::findOrfail($item);
                    $list->delete();
                }
            } 
            else 
            {
                $list = User::findOrfail($id);
                $list->delete();
            }
            $request->session()->flash('success', 'Xóa dữ liệu thành công !!!');
            return redirect()->route('indexUser'); 
        }
    }
    
    public function filter(Request $request)
    {
        $key = true ;
        $requests = array('publish'=>$request->publish,'role_id'=>$request->phancap);
        foreach ($requests as $key => $value) 
        {
            if($value != 'All')
            {
                $DB[] = array($key,'=',$value);
            }
        }
        if(isset($DB))
        {
            $user = User::where($DB)->paginate(8);
            if($user[0] == null)
            {
                return view('admin/users/list',['users'=>$user,'key'=>$key,'publish'=>$request->publish,'role'=>$request->phancap]);
            }
            else
            {
                return view('admin/users/list',['users'=>$user,'key'=>$key,'publish'=>$request->publish,'role'=>$request->phancap]);
            }
        }  
        else
        {
            return redirect()->route('indexUser');
        }
        $user = new User();
        return view('admin/users/list',['users'=>$user->paginate(8),'key'=>$key,'publish'=>$request->publish,'role'=>'All']);
    }
}
