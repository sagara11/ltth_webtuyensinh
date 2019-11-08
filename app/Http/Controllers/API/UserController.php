<?php
namespace App\Http\Controllers\API;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Firebase\JWT\JWT;
use RestApi\Utility\JwtToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Facebook\Facebook;
use App\SocialNetwork;
use Illuminate\Support\Facades\Log;
use Mail;
class UserController extends BaseController
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
     public function index(Request $request)
    { 
        try{
                $token = $request->header('token');
                $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
                if($gettoken == null)
                {
                    $response = [
                        'status' => false,
                        'message' => '$token is invalid !!! ',
                    ];
                    return response()->json($response);
                }
                $user = User::where('id',$gettoken[0])->select('id','name','email','avatar')->first();
                $response = [
                        'status' => true,
                        'message' => 'User Data',
                        'info' => $user,
                    ];
                return response()->json($response);
        }
        catch(\Exception $e){
                $response = [
                        'status' => false,
                        'message' => 'Get information fail!!!',
                    ];
                return response()->json($response);
        }
    }

    public function change_password(Request $request)
    {
        $data = User::where('email',$request->email)->first();
        if(empty($data))
        {
            $response = [
                    'status' => false,
                    'message' => 'Không tồn tại email này !!!',
                ];
            return response()->json($response);
        }
        else
        {
            $email = $data->email;
            Mail::send('admin/mailfb', array('name'=>$data->name,'content'=>'Please click the link below to retrieve your password !!!', 'link'=>'Link: https:/#'), function($message) use($email) {
                $message->to($email, 'Verified Password!!!')->subject('Please click the link below to retrieve your password !!!');
            });
            $response = [
                    'status' => true,
                    'message' => 'Send message successfully!',
                ];
            return response()->json($response);
        }
    }
    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    
     public function update(Request $request, User $user)
    {
        // try{ 
                $token = $request->header('token');
                $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
                if($gettoken == null)
                {
                    $response = [
                        'status' => false,
                        'message' => '$token is invalid !!! ',
                    ];
                    return response()->json($response);
                }
                $id = $gettoken[0];
                $user = User::find($gettoken[0]);
                // xu li phan thay doi mat khau
                if(isset($request->password) || isset($request->new_password))
                {
                    if($request->password != null && $request->new_password != null)
                    {
                        if(Hash::check($request->password,$user->password))
                        {
                            $user->password = Hash::make($request->new_password);
                        } 
                        else
                        {
                            $response = [
                            'status' => false,
                            'message' => 'Your password does not match any other password !!!',
                            ];
                            return response()->json($response);
                        }
                    }   
                    else
                    {
                        $response = [
                        'status' => false,
                        'message' => 'please fill the password or new password !!!',
                        ];
                        return response()->json($response);
                    }
                }
                // xu li phan anh
                if($request->file('avatar') != null)
                {
                    $avatar = $this->Xulyupload($request,$user->name);
                    $user->avatar = $avatar ;
                }
                $user->name = $request->name ? $request->name : $user->name ;
                $user->email = $request->email ? $request->email : $user->email ;
                $user->save();
                $data = User::where('id',$id)->select('id','name','email','avatar')->first();
                $response = [
                    'status' => true,
                    'message' => 'Update success',
                    'info' => $data 
                ];
                return response()->json($response);
        // }
        // catch(\Exception $e) {
        //     $response = [
        //         'status' => false,
        //         'message' => 'Update fail!!!',
        //     ];
        //     return response()->json($response);
        // }
    }
    public function Xulyupload(Request $rq,$name)
    {
        $rules = [ 'avatar' => 'avatar|max:1024' ]; 
        $posts = [ 'avatar' => $rq->file('avatar') ];

        $valid = Validator::make($posts, $rules);
            // Ko có lỗi, kiểm tra nếu file đã dc upload
            if ($rq->file('avatar')->isValid()) {
                // Filename cực shock để khỏi bị trùng
                $fileName = $rq->file('avatar')->storeAs('userfiles/images/avatar','avatar'.$name.'.jpg');
                // Thư mục upload
                $uploadPath = public_path('userfiles\images\avatar'); // Thư mục upload
                // Bắt đầu chuyển file vào thư mục
                $rq->file('avatar')->move($uploadPath,$fileName);
                // Thành công, show thành công
                $photoURL = url($fileName);
                return $photoURL;
            }
            else {
                // Lỗi file
                 $response = [
                    'status' => false,
                    'message' => ' Update Avatar fail !!!!',
                ];
                    return response()->json($response);
            }
        }
    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $email = $request->email ;
        $password = $request->password ; 
        $data = User::where('email',$email)->first();
        //check
        if($data == null)
        {
            return response()->json(['Login Fail !!!'], 500);
        }
        else
        {
            if(Hash::check($password,$data->password))
            {
                $id = $data->id;
                $time = time();
                $token = JWT::encode([$id , $time] , env('JWT_KEY'));
                $info = array(
                    'id'=>$data->id,
                    'name'=>$data->name,
                    'email'=>$data->email,
                    'avatar'=>$data->avatar
                );
                $response = [
                    'status' => true,
                    'message' => 'Login success',
                    'token' => $token,
                    'info' => $info,
                ];
                return response()->json($response);
            }
            else
            {
                return response()->json(['Wrong password !!!'], 500);
            }
        }
    }
    public function login_social(Request $request)
    {
        $provider = $request->type;
        if ($provider == 'google') {
            return $this->checkGoogle();
        }

        if ($provider == 'facebook') {
            return $this->checkFacebook($request);
        }
    }
    public function check_id($id)
    {
        $data = SocialNetwork::where('social_id',$id)->first();
        return $data;
    }
    public function checkFacebook(Request $request)
    {
        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_access_token' => $request->token,
        ]);     
        try {
              // Get the \Facebook\GraphNodes\GraphUser object for the current user.
              // If you provided a 'default_access_token', the '{access-token}' is optional.
              $response = $fb->get("/me?fields=id,email,first_name");
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              echo 'Graph returned an error: ' . $e->getMessage();
              exit();
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit();
            }
        try{
                $me = $response->getGraphUser();
                $check = $this->check_id($me['id']);
                $user = '';
                // check id
                if(empty($check))
                {
                    //check email
                    $check_email = User::where('email',$me['email'])->first();
                    if(!empty($check_email))
                    {
                        // them tai khoan
                        $avatar = 'http://graph.facebook.com/'.$me['id'].'/picture?type=square';
                        $id = ($this->add_new($check_email,$me['id'],$me['first_name'],$avatar));
                        $user = User::where('id',$id)->select('id','name','email','avatar')->first();
                    }
                    else
                    {
                        $response = [
                            'status' => false,
                            'message' => 'Khong co email !!!',
                        ];
                        return response()->json($response);
                    }
                }
                else
                {
                    $user = User::where('id',$check->user_id)->select('id','name','email','avatar',)->first();
                }
                // luu vao social network
                if(empty($check)){
                    $data = new SocialNetwork();
                    $data->user_id = $user->id;
                    $data->social_id = $me['id'];
                    $data->provider = 'Facebook';
                    $data->save();
                }
                // cap token
                $time = time();
                $token = JWT::encode([$user->id, $time] , env('JWT_KEY'));

                $response = [
                            'status' => true,
                            'message' => 'Login success',
                            'token' => $token,
                            'info' => $user,
                        ];
                        return response()->json($response);
        }catch(\Exception $e)
        {
            $response = [
                            'status' => false,
                            'message' => 'Login Fail!!!',
                        ];
                        return response()->json($response);
        }
    }
    public function add_new($user,$id,$name,$avatar)
    {
        try{
            $user->name  = $name;
            $user->avatar = $avatar;
            $user->password = Hash::make('admin123');
            $user->publish = 1 ;
            $user->save();
            return $user->id ;
        }catch(\Exception $e)
        {
            $response = [
                            'status' => false,
                            'message' => 'Add Fail!!!',
                        ];
                        return response()->json($response);
        }
    }
    public function comments(Request $request)
    {
        try{
            $token = $request->header('token');
            $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
            if($gettoken == null)
                {
                    $response = [
                        'status' => false,
                        'message' => '$token is invalid !!! ',
                    ];
                    return response()->json($response);
                }
            $comments = Comment::select('id','comment','created_at','post_id')->with(array(
                    'post' => function($comments)
                    {
                        $comments->select('id','name');
                    }))->where('user_id', $gettoken[0]);
                $limit = isset($request->limit) ? $request->limit : 10 ;
                $comments = $comments->paginate($limit);
                $response = [
                            'status'  => true,
                            'comment' => $comments,
                        ];
                return response()->json($response);
        }
        catch(\Exception $e)
        {
            $response = [
                        'status'  => false,
                        'message' => 'Fail!!',
                    ];
            return response()->json($response);
        }
    }
    public function responseErrors($returnCode, $message, $statusCode = 200)
    {
        return response()->json([
            'code' => (int) $returnCode,
            'message' => $message,
        ], $statusCode);
    }
    public function responseSuccess($data, $statusCode = 200)
    {
        return response()->json(array_merge(['code' => 200], $data), $statusCode);
    }
    public function register(Request $request)
    {
        if($request->email != '' && $request->password != '')
        {
            try{
                $user = new User();
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->publish = 1 ;
                $user->save();
                $response = [
                        'status'  => true,
                        'message' => 'Register success!!!',
                    ];
                return response()->json($response);
            }catch(\Exception $e)
            {
                $response = [
                        'status'  => false,
                        'message' => 'This email has existed!!!',
                    ];
            return response()->json($response);
            }
        }
        else
        {
            $response = [
                        'status'  => false,
                        'message' => 'Please fill the email or password !!!',
                    ];
            return response()->json($response);
        }
    }
}