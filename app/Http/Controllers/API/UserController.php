<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;

 
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
        return $this->sendResponse($user->toArray(), 'user retrieved successfully.');
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
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'id' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::create($input);

        return $this->sendResponse($user->toArray(), 'Product created successfully.');
    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);
    }
    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::where('id',$id)->select('id','name','image')->get();
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        return $this->sendResponse($user->toArray(), 'User retrieved successfully.');
    }
     public function update(Request $request, User $user)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'id' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->avatar = $input['avatar'];
        $user->save();

        return $this->sendResponse($user->toArray(), 'user updated successfully.');
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->sendResponse($user->toArray(), 'user deleted successfully.');
    }
}