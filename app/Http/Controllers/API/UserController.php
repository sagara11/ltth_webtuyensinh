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
        $token = $request->header('token');
        $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
        $user = User::where('id',$gettoken[0])->select('name','email','avatar')->get();
        $response = [
                    'status' => true,
                    'message' => 'User Data',
                    'info' => $user,
                ];
        return response()->json($response);
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
        $token = $request->header('token');
        $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
        $user = User::find($gettoken[0]);
        if($token != null)
        {
            $user->name = $request->header('name') ? $request->header('name') : $user->name ;
            $user->email = $request->header('email') ? $request->header('email') : $user->email ;
            $user->avatar = $request->header('avatar') ? $request->header('avatar') : $user->avatar ;
            $user->save();
            $response = [
                    'status' => true,
                    'message' => 'Update success',
                ];
                return response()->json($response);
        }
        else
        {
            return response()->json(['Update Fail !!!'], 500);
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
                return response()->json(['Login Fail !!!'], 500);
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
    public function checkFacebook(Request $request)
    {
        $fb = new Facebook([
            'app_id' => '413891859271505',
            'app_secret' => 'f678f181e0829f8708594e9a742d0886',
            'default_graph_version' => 'v2.10',
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
        $me = $response->getGraphUser();
        $user = User::where('name',$me['first_name'])->select('id','avatar','name','email')->first();

        $time = time();
        $token = JWT::encode([$user->id, $time] , env('JWT_KEY'));
    
        $data = new SocialNetwork();
        $data->user_id = $user->id;
        $data->social_id = $me['id'];
        $data->provider = 'Facebook';
        $data->save();
        $info = array(
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'avatar'=>$user->avatar,
                );
        $response = [
                    'status' => true,
                    'message' => 'Login success',
                    'token' => $token,
                    'info' => $info,
                ];
                return response()->json($response);
    }
    public function checkGoogle()
    {
        // require_once 'C:/xampp/htdocs/webtuyensinh/vendor/google/graph-sdk/src/Facebook/autoload.php';
        $Client = new Google_Client();
        $Client->secClientId();
        $Client->setClientSecret();
    }

    public function comments(Request $request)
    {
        $token = $request->header('token');
        $gettoken = JWT::decode($token, env('JWT_KEY'), array('HS256'));
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
}