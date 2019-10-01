<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Firebase\JWT\JWT;
use RestApi\Utility\JwtToken;
use Illuminate\Support\Facades\Hash;

 
class UserController extends BaseController
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
     public function index()
    { 
        $user = User::select('avatar','name','email')->jsonPaginate(10);
        return $this->sendResponse($user->toArray(), 'user retrieved successfully.','info');
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
        $data = $request->header('token');
        $user = User::where('api_token',$data)->get();
        if(!empty($user[0]))
        {
            $insert = User::find($user[0]['id']);
            $insert->name = $request->header('name') ? $request->header('name') : $user[0]['name'] ;
            $insert->email = $request->header('email') ? $request->header('email') : $user[0]['email'] ;
            $insert->avatar = $request->header('avatar') ? $request->header('avatar') : $user[0]['avatar'] ;
            $insert->save();
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
                $time = time();
                $token = JWT::encode([12, $time] , env('JWT_KEY'));
                $insert = User::find($data[0]['id']) ;
                $insert->api_token = $token ;
                $insert->save();
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
}