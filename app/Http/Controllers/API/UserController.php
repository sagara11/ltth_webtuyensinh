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
        $data = User::where('email',$email)->get();
        //check
        if(empty($data[0]))
        {
            return response()->json(['Login Fail !!!'], 500);
        }
        else
        {
            if(Hash::check($password,$data[0]['password']))
            {
                $id = $data[0]['id'];
                $time = time();
                $token = JWT::encode([$id , $time] , env('JWT_KEY'));
                $info = array(
                    'name'=>$data[0]['name'],
                    'email'=>$data[0]['email'],
                    'avatar'=>$data[0]['avatar']
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
}